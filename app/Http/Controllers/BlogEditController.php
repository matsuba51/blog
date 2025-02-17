<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog; // Blogモデルをインポート

class BlogEditController extends Controller
{
    // 新規投稿フォーム
    public function create()
    {
        // ログインしていない場合はログインページへリダイレクト
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインが必要です');
        }

        return view('blogs.create');
    }

    // 新規投稿処理
    public function store(Request $request)
    {
        // ログインしていない場合はログインページへリダイレクト
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインが必要です');
        }

        // バリデーションなどの処理
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $blog = new Blog();
        $blog->title = $validated['title'];
        $blog->body = $validated['body'];
        $blog->user_id = Auth::id();  // ログインユーザーのIDを設定
        $blog->save();

        return redirect()->route('blogs.index')->with('success', '新規投稿が完了しました');
    }


    // 更新処理
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        // 対象のブログを更新
        $blog = Blog::findOrFail($id);
        $blog->update([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('blogs.index')->with('success', 'ブログが更新されました！');
    }

    // 削除処理
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'ブログが削除されました！');
    }

    // 編集ページ
    public function edit($id)
    {
        // ブログをIDで検索
        $blog = Blog::findOrFail($id);

        // 自分の投稿したブログのみ編集できるように確認
        if (Auth::id() !== $blog->user_id) {
            abort(403);
        }

        // 編集ページにブログデータを渡す
        return view('blogs.edit', compact('blog'));
    }
}