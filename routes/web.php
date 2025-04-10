<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Admin\ChartController;
use App\Http\Middleware\AdminMiddleware; 

// 認証ルートを登録
require __DIR__.'/auth.php';

Route::get('/check-auth', function () {
    dd(Auth::check(), Auth::user());
});

// 一般ユーザー向けルート（認証不要）
Route::get('/', [BlogController::class, 'index'])->name('home');
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/create', [BlogController::class, 'create'])->name('blog.create')->middleware('auth');
Route::post('/blogs', [BlogController::class, 'store'])->name('blog.store')->middleware('auth');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blog.show');

// ユーザー登録フォーム表示
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

// ユーザー登録処理
Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');


// 以下、ログインユーザーのみアクセス可能なルート
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'edit'])->name('dashboard');
    Route::put('/dashboard', [ProfileController::class, 'update'])->name('dashboard.update');

    // ブログ関連
    Route::delete('/users/{id}', [ProfileController::class, 'destroy'])->name('user.destroy');
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');

    // コメント関連
    Route::post('/blogs/{id}/comments', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comment.edit');
    Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comment.update');
});

// 🔹 管理者専用ルート（AdminMiddleware に変更）
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // ブログ管理
    Route::get('/blogs', [AdminBlogController::class, 'index'])->name('blogs');
    Route::get('/blogs/{id}', [AdminBlogController::class, 'show'])->name('blogs.show');
    Route::put('/blogs/{id}', [AdminBlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{id}', [AdminBlogController::class, 'destroy'])->name('blogs.destroy');

    // ユーザー管理
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    Route::get('/users/{id}', [AdminUserController::class, 'show'])->name('users.show');
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy'])->name('users.destroy'); 

    // タグ管理
    Route::get('/tags', [AdminTagController::class, 'index'])->name('tags');
    Route::get('/tags/create', [AdminTagController::class, 'create'])->name('tags.create');
    Route::post('/tags', [AdminTagController::class, 'store'])->name('tags.store');
    Route::get('/tags/{tag}/edit', [AdminTagController::class, 'edit'])->name('tags.edit');
    Route::put('/tags/{tag}', [AdminTagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{tag}', [AdminTagController::class, 'destroy'])->name('tags.destroy');

    // 日ごとの投稿数
    Route::get('/charts', [ChartController::class, 'index'])->name('charts');
});
