<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Comment;

use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function comment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $data = $request->all();
        $data['post_id'] = $id;
        $data['user_id'] = Auth::user()->id;
        Comment::create($data);

        return redirect('/blog/'.$id);

    }
}
