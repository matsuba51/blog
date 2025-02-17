<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // ブログ一覧
    public function index()
    {
        $blogs = Blog::with('user')
                ->orderBy('created_at', 'desc') // 新規順で並べる
                ->get();
        return view('blogs.index', compact('blogs'));
    }

    // ブログ詳細
    public function show($id)
    {
        $blog = Blog::with('user', 'comments.user')->findOrFail($id); // コメントも含めて取得
        return view('blogs.show', compact('blog'));
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        // 投稿者のみが削除できる
        if (Auth::id() !== $blog->user_id) {
            return redirect()->route('blogs.index')->with('error', 'このブログを削除する権限がありません。');
        }

        // ブログを削除
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'ブログが削除されました。');
    }

    
}