<?php


use App\Http\Controllers\PostController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;



// homepage
Route::get('/', function () {
    $posts = [];
    if (auth()->check()) {
        // if user is logged in, get all posts from people they follow
        $posts = auth()->user()->usersCoolPosts()->latest()->get();
    }

    return view('home', ['posts' => $posts]);
});


// Registering and logging in
Route::post('/register',[userController::class,'register']);
Route::post('/login', [userController::class, 'login']);
Route::post('logout', [userController::class, 'logout']);


// Blog related routes
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditScreen']);
Route::put('/edit-post/{post}', [PostController::class, 'actuallyUpdatePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);

