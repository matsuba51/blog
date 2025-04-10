<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = Comment::findOrFail($id);

        if ($comment->user_id != auth()->id()) {
            return redirect()->route('blog.show', $comment->blog_id)->with('error', '権限がありません');
        }

        $comment->update($request->only('content'));

        return redirect()->route('blog.show', $comment->blog_id)->with('success', 'コメントが更新されました');
    }

    public function store(Request $request, $blogId)
    {
        $request->validate([
            'content' => 'required|max:500',
        ]);

        // コメントを作成してブログに紐づける
        $comment = new Comment();
        $comment->content = $request->content;
        $comment->user_id = Auth::id();
        $comment->blog_id = $blogId;
        $comment->save();

        return redirect()->route('blog.show', $blogId)->with('success', 'コメントを投稿しました');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id != auth()->id()) {
            return redirect()->route('blog.show', $comment->blog_id)->with('error', '権限がありません');
        }

        return view('comments.edit', compact('comment'));
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->user_id != Auth::id()) { 
            return redirect()->route('blog.index')->with('error', '権限がありません');
        }

        $comment->delete();
        return redirect()->back()->with('success', 'コメントを削除しました');
    }
}