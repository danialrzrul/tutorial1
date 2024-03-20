<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    $posts = [];
    //this if statement will get the posts of the logged in user
    if (auth()->check()) {
        $posts = auth()->user()->usersCreatedPost()->latest()->get();
        //$posts = Post::where('user_id', auth()->id())->get(); //not recommended
    }
    
    return view('form', ['posts' => $posts]);
});

//User related route
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']); 
Route::post('/login', [UserController::class, 'login']);

//Blog post related route
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'editPost']);
Route::put('/edit-post/{post}', [PostController::class, 'updatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);