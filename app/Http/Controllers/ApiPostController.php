<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class ApiPostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->orderBy('created_at', 'desc')->get();
        
        return response()->json($posts);
    }

    public function getSearchResults(Request $request)
    {
        $data = $request->get('data');

        $posts = DB::table('posts')
                    ->join('categories AS cate', 'category_id', '=', 'cate.id')
                    ->where('title', 'like', "%{$data}%")
                    ->orWhere('cate.name', 'like', "%{$data}%")
                    ->select('posts.*', 'cate.name')
                    ->get();
        
        return response()->json($posts);
    }
}
