<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //$myPosts = Post::where('user_id', auth()->id())->get();
    $myPosts = [];
    $eachPostComments = [];

    if (auth()->check()) {
        $myPosts = auth()->user()->usersCoolPosts()->latest()->get();
    }
    $posts = Post::with('postCoolComments')->get();
    /* 
        foreach ($posts as $post) {
            $eachPostComments = $eachPostComments->merge($post->postCoolComments()->latest()->get());
        } */
    return view('home', ['myPosts' => $myPosts, 'posts' => $posts,]);
});

Route::post('/register', [UserController::class, 'register']);

Route::post('/logout', [UserController::class, 'logout']);

Route::post('/login', [UserController::class, 'login']);

// Blog routs

Route::post('/create-post', [PostController::class, 'createPost']);

Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);

Route::post('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);

Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);

// Comment routs

Route::post('/create-comment/{post}', [CommentController::class, 'createComment']);