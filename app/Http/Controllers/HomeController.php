<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::with('category')->orderBy('created_at', 'desc')->paginate(11);
        // dd($posts);
        $newPost = $posts->shift();
        
        // $posts = $posts->chunk(2);
        // $posts->toArray();

        return view('index', compact('newPost', 'posts'));
    }
}
