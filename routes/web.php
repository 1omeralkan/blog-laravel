<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [PostController::class, 'myPosts'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/{post:slug}/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/posts/{post}/approve', [App\Http\Controllers\PostController::class, 'approve'])->name('posts.approve');
    Route::post('/comments/{comment}/approve', [App\Http\Controllers\CommentController::class, 'approve'])->name('comments.approve');
    Route::post('/admin/users/{user}/make-admin', [App\Http\Controllers\ProfileController::class, 'makeAdmin'])->name('admin.makeAdmin');
    Route::delete('/admin/users/{user}', [App\Http\Controllers\ProfileController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::post('/admin/users/{user}/toggle-admin', [App\Http\Controllers\ProfileController::class, 'toggleAdmin'])->name('admin.toggleAdmin')->middleware('auth');
    Route::get('/comments/{comment}/edit', [App\Http\Controllers\CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [App\Http\Controllers\CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}/reject', [App\Http\Controllers\CommentController::class, 'reject'])->name('comments.reject')->middleware('auth');
    Route::delete('/posts/{post}/reject', [App\Http\Controllers\PostController::class, 'reject'])->name('posts.reject')->middleware('auth');
});

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/users/{user}', [App\Http\Controllers\ProfileController::class, 'show'])->name('users.show');

Route::get('/logout', function () {
    return redirect('/');
});

// Fallback: Eğer giriş yapmamış kullanıcı korumalı bir route'a giderse ana sayfaya yönlendir
Route::fallback(function () {
    if (!auth()->check()) {
        return redirect('/');
    }
    abort(404);
});

// NewsAPI headlines endpoint
Route::get('/api/news/headlines', [NewsController::class, 'headlines']);

require __DIR__.'/auth.php';
