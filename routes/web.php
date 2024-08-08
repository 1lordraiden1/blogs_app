<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Middleware\EnsureUserIsValidForPost;

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
    $posts = Post::with('postCoolComments')->with('user')->latest()->get();
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



Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen'])->middleware('post');


Route::post('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost'])->middleware('post');

Route::delete('/delete-post/{post}', [PostController::class, 'deletePost'])->middleware('post');

// Comment routs

Route::post('/create-comment/{post}', [CommentController::class, 'createComment']);

Route::get('/edit-comment/{comment}', [CommentController::class, 'showEditScreen'])->middleware('comment');

Route::post('/edit-comment/{comment}', [CommentController::class, 'actuallyUpdateComment'])->middleware('comment');

Route::delete('/delete-comment/{comment}', [CommentController::class, 'deleteComment'])->middleware('comment');