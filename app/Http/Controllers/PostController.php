<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function deletePost(Post $post)
    {
        if (auth()->user()->id === $post->user_id) {
            $post->delete();

        }
        return redirect('/');
    }
    public function actuallyUpdatePost(Post $post, Request $request)
    {
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/');
        }

        $post->title = $request->title;
        //Rule::unique('test')->ignore($post->id, 'post_id')

        $fields = $request->validate([
            'title' => "required|unique:test,title,$post->id,post_id",
            'body' => 'required',
        ]);


        $fields['title'] = strip_tags($fields['title']);
        $fields['body'] = strip_tags($fields['body']);

        $post->update($fields);

        return redirect('/');

    }
    public function showEditScreen(Post $post)
    {
        if ($post->user_id !== auth()->user()->id) {
            return redirect('/');
        }
        return view("edit-post", ['post' => $post]);
    }

    public function createPost(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $fields['title'] = strip_tags($fields['title']);
        $fields['body'] = strip_tags($fields['body']);

        $fields['user_id'] = auth()->id();

        Post::create($fields);

        return redirect('/');
    }
}
