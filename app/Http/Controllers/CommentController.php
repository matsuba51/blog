<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // コメントの保存処理
    public function store(Request $request, Blog $blog)
    {
        $request->validate([
            'content' => 'required|string|max:500', // バリデーション
        ]);

        // コメントの保存
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = auth()->id(); // ログインユーザーのID
        $comment->blog_id = $blog->id;
        $comment->save();

        return redirect()->back()->with('success', 'コメントが追加されました。');
    }

    // コメントの編集ページ
    public function edit(Comment $comment)
    {
        // コメントが存在することを確認
        return view('comments.edit', compact('comment'));
    }

    // コメントの更新処理
    public function update(Request $request, Comment $comment)
    {
        // ログインユーザーがコメントの所有者でない場合はアクセスを拒否
        if (Auth::id() !== $comment->user_id) {
            abort(403, 'You do not have permission to edit this comment.');
        }

        // 入力値のバリデーション
        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        // デバッグ: 変更前後の内容をログに記録
        \Log::info('コメント更新リクエスト', [
            'before' => $comment->content,
            'after' => $request->input('content'),
        ]);

        // コメント内容を更新
        $comment->content = $request->input('content');
        $result = $comment->save(); // 成功すれば true, 失敗なら false

        // デバッグ: データベースへの保存が成功したか確認
        \Log::info('コメント更新結果', ['result' => $result]);

        // 成功した場合、コメントが更新されたことをユーザーに通知
        if ($result) {
            return redirect()->route('blogs.show', $comment->blog_id) // コメントが関連するブログ詳細ページにリダイレクト
                ->with('success', 'コメントが更新されました');
        }

        // 失敗した場合
        return redirect()->back()->with('error', 'コメントの更新に失敗しました');
    }
    
    // コメントの削除処理
    public function destroy(Comment $comment)
    {
        // 投稿者のみ削除可能
        if (Auth::id() !== $comment->user_id) {
            abort(403);
        }

        $comment->delete();

        return redirect()->back()->with('success', 'コメントを削除しました');
    }
}