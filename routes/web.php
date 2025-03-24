<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);

Route::get('/posts', function () {
    return view('posts.index');
})->middleware(['auth', 'verified'])->name('posts.index');

Route::get('/posts', function () {
    return view('posts.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('posts', PostController::class);

// コメントを投稿するルーティング
Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

// いいねを投稿するルーティング
Route::post('posts/{post}/likes', [LikeController::class, 'toggleLike'])->name('posts.like')->middleware('auth');

require __DIR__.'/auth.php';
