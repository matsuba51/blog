<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // ブログ一覧表示
    public function index()
    {
        $blogs = Blog::all();  // すべてのブログを取得
        return view('admin.blogs.index', compact('blogs'));  // ブログ一覧ページにデータを渡す
    }

    // 新規ブログ作成フォーム
    public function create()
    {
        return view('admin.blogs.create');  // 新規ブログ作成ページを表示
    }

    // 新規ブログの保存
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // 新しいブログを保存
        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),  // 現在ログインしているユーザーIDを保存
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'ブログが作成されました。');
    }

    // ブログ詳細表示
    public function show($id)
    {
        $blog = Blog::findOrFail($id);  // 指定されたIDのブログを取得
        return view('admin.blogs.show', compact('blog'));  // 詳細ページにブログを渡す
    }

    // ブログ編集フォーム
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);  // 指定されたIDのブログを取得
        return view('admin.blogs.edit', compact('blog'));  // 編集フォームにデータを渡す
    }

    // ブログの更新
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $blog = Blog::findOrFail($id);  // 指定されたIDのブログを取得

        // ブログを更新
        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.blogs.index')->with('success', 'ブログが更新されました。');
    }

    // ブログの削除
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);  // 指定されたIDのブログを取得
        $blog->delete();  // ブログを削除

        return redirect()->route('admin.blogs.index')->with('success', 'ブログが削除されました。');
    }

    // ブログの承認
    public function approve($id)
    {
        $blog = Blog::findOrFail($id);  // 指定されたIDのブログを取得
        $blog->update(['approved' => true]);  // 承認済みに更新

        return redirect()->route('admin.blogs.index')->with('success', 'ブログが承認されました。');
    }

    // ブログの承認解除
    public function unapprove($id)
    {
        $blog = Blog::findOrFail($id);  // 指定されたIDのブログを取得
        $blog->update(['approved' => false]);  // 承認解除

        return redirect()->route('admin.blogs.index')->with('success', 'ブログの承認が解除されました。');
    }
}