<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function deletePost(Post $post, Request $request)
    {
        $request->merge(['post' => $post]);
        if ($post->isPostOwner()) {
            $post->delete();

        }
        return redirect('/');
    }
    public function actuallyUpdatePost(Post $post, Request $request)
    {
        $request->merge(['post' => $post]);

        if (!$post->isPostOwner()) {
            return redirect('/');
        }

        //$post->title = $request->title;
        //Rule::unique('test')->ignore($post->id, 'post_id')

        $fields = $request->validate([
            'title' => "required|unique:posts,title,{$post->title}",
            'body' => 'required',
        ]);


        $fields['title'] = strip_tags($fields['title']);
        $fields['body'] = strip_tags($fields['body']);

        $post->update($fields);

        return redirect('/');

    }
    public function showEditScreen(Post $post, Request $request)
    {
        $request->merge(['post' => $post]);

        if (!$post->isPostOwner()) {
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
