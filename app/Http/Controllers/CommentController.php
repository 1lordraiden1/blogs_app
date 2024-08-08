<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function deleteComment(Comment $comment)
    {
        if ($comment->user_id === auth()->user()->id || $comment->user_id === auth()->user()->id) {
            $comment->delete();

        }
        return redirect('/');
    }
    public function actuallyUpdateComment(Comment $comment, Request $request)
    {
        if ($comment->user_id !== auth()->user()->id && $comment->post()->get()->first()->user_id !== auth()->user()->id) {
            return redirect('/');
        }

        //$post->title = $request->title;
        //Rule::unique('test')->ignore($post->id, 'post_id')

        $fields = $request->validate([
            'content' => "required",
        ]);


        $fields['content'] = strip_tags($fields['content']);


        $comment->update($fields);

        return redirect('/');

    }

    public function showEditScreen(Comment $comment)
    {
        if ($comment->user_id !== auth()->user()->id && $comment->post()->get()->first()->user_id !== auth()->user()->id) {
            return redirect('/');
        }
        return view("edit-comment", ['comment' => $comment]);
    }

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
