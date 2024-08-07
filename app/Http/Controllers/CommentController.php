<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    
    public function createComment(Request $request, Post $post)
    {
        $fields = $request->validate([
            'content' => 'required',
        ]);

        $fields['content'] = strip_tags($fields['content']);

        $fields['user_id'] = auth()->id();

        $fields['post_id'] = $post->id;


        Comment::create($fields);

        return redirect('/');
    }
}
