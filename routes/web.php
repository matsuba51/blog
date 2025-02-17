<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    BlogController, BlogEditController, AuthController, CommentController, UserController
};
use App\Http\Controllers\Admin\{
    DashboardController, BlogController as AdminBlogController, UserController as AdminUserController, TagController as AdminTagController
};

//公開ルート（ログイン不要）
Route::get('/', [BlogController::class, 'index'])->name('home'); // トップページ
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index'); // ブログ一覧
Route::get('/blogs/create', [BlogEditController::class, 'create'])->name('blogs.create'); // 新規投稿フォーム
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show'); // ブログ詳細
Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');// ブログ削除

//認証が必要なルート
Route::middleware('auth')->group(function () {
    // ブログ操作
    Route::post('/blogs', [BlogEditController::class, 'store'])->name('blogs.store'); // 投稿作成
    Route::get('/blogs/{id}/edit', [BlogEditController::class, 'edit'])->name('blogs.edit'); // 投稿編集
    Route::put('/blogs/{id}', [BlogEditController::class, 'update'])->name('blogs.update'); // 投稿更新
    Route::delete('/blogs/{id}', [BlogEditController::class, 'destroy'])->name('blogs.destroy'); // 投稿削除

    // コメント操作
    Route::post('/blogs/{blog}/comments', [CommentController::class, 'store'])->name('comments.store'); // コメント投稿
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit'); // コメント編集
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update'); // コメント更新
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy'); // コメント削除

    // ユーザー情報編集
    Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/update', [UserController::class, 'update'])->name('user.update');

    // ログアウト
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

//認証関連
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/register/complete', [AuthController::class, 'registerComplete'])->name('register.complete');

//運営管理画面
Route::prefix('admin')->middleware('auth')->group(function () {
    // ダッシュボード
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // ブログ管理
    Route::get('/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs.index');
    Route::get('/blogs/create', [AdminBlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('/blogs', [AdminBlogController::class, 'store'])->name('admin.blogs.store');
    Route::get('/blogs/{blog}', [AdminBlogController::class, 'show'])->name('admin.blogs.show');
    Route::get('/blogs/{blog}/edit', [AdminBlogController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('/blogs/{blog}', [AdminBlogController::class, 'update'])->name('admin.blogs.update');
    Route::delete('/blogs/{blog}', [AdminBlogController::class, 'destroy'])->name('admin.blogs.destroy');
    Route::post('/blogs/{blog}/approve', [AdminBlogController::class, 'approve'])->name('admin.blogs.approve');
    Route::post('/blogs/{blog}/unapprove', [AdminBlogController::class, 'unapprove'])->name('admin.blogs.unapprove');

    // ユーザー管理
    Route::get('/users', [AdminUserController::class, 'index'])->name('admin.users.index');  // ユーザー一覧
    Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');  // ユーザー作成フォーム
    Route::post('/users', [AdminUserController::class, 'store'])->name('admin.users.store');  // ユーザー登録
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('admin.users.show');  // ユーザー詳細
    Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');  // ユーザー編集フォーム
    Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('admin.users.update');  // ユーザー更新
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');  // ユーザー削除

    // タグ管理
    Route::get('/tags', [AdminTagController::class, 'index'])->name('admin.tags.index');  // タグ一覧
    Route::get('/tags/create', [AdminTagController::class, 'create'])->name('admin.tags.create');  // タグ作成フォーム
    Route::post('/tags', [AdminTagController::class, 'store'])->name('admin.tags.store');  // タグ登録
    Route::get('/tags/{tag}', [AdminTagController::class, 'show'])->name('admin.tags.show');  // タグ詳細
    Route::get('/tags/{tag}/edit', [AdminTagController::class, 'edit'])->name('admin.tags.edit');  // タグ編集フォーム
    Route::put('/tags/{tag}', [AdminTagController::class, 'update'])->name('admin.tags.update');  // タグ更新
    Route::delete('/tags/{tag}', [AdminTagController::class, 'destroy'])->name('admin.tags.destroy');  // タグ削除
    
});