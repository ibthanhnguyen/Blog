<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Redirect;

class BlogController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::get();

        return view('posts.create_new_post', $data);
    }

    public function createNewPost(Request $request)
    {
        $request->validate([
            'title' => 'required|max:120',
            'description' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'required|max:2048|mimes:jpeg,jpg,png'
        ]);

        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('storage/images'), $imageName);

        $data = $request->all();
        $data['image'] = $imageName;
        $data['user_id'] = Auth::id();
        Post::create($data);

        return back();
    }

    public function listPosts()
    {
        $posts = Post::with(['user', 'category'])->where('user_id', Auth::user()->id)->paginate(10);

        return view('posts.list-post', compact('posts'));
    }

    public function blogOfCategory(Request $request, $id)
    {
        $key = $request->key;
        
        if ($key == 'asc') {
            $posts = Post::where('category_id', $id)->with('user')->orderBy('created_at', 'ASC')->paginate(10);
        } else {
            $posts = Post::where('category_id', $id)->with('user')->orderBy('created_at', 'DESC')->paginate(10);
        }

        return view('posts.category', compact('posts', 'key'));
    }

    public function showBlogDetail($id)
    {
        $blog = Post::with(['user', 'comments' => function($cmt) {
            $cmt->take(10);
        }])->find($id);

        return view('posts.blog_detail', compact('blog'));
    }

    public function sort(Request $request)
    {
        return route('sort-result', ['key' => $request->sort]);
    }

    public function sortResult(Request $request)
    {
        $key = $request->key;
        
        if ($key == 'asc') {
            $posts = Post::with(['user', 'category'])->orderBy('created_at', 'ASC')->paginate(10);
        } else {
            $posts = Post::with(['user', 'category'])->orderBy('created_at', 'DESC')->paginate(10);
        }

        return view('posts.search_result', compact('posts', 'key'));
    }
}
