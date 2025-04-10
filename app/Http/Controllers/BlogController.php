<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');

        $blogs = Blog::query()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                            ->orWhere('content', 'like', "%{$search}%");
            })
            ->latest('created_at')
            ->paginate(8);
            // dd($blogs);
        return view('blogs.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::with(['user', 'comments.user', 'tags'])->findOrFail($id);
        $tags = Tag::all(); 
        
        return view('blogs.show', compact('blog', 'tags'));
    }

    public function create()
    {
        $tags = Tag::all();

        return view('blogs.create', compact('tags'));
    }

    public function store(Request $request)
    {
        try {
            // バリデーション
            $validated = $request->validate([
                'title' => 'required|max:255',
                'content' => 'required',
                'tags' => 'array|exists:tags,id',
            ]);

            $blog = Blog::create([
                'title' => $validated['title'],
                'content' => $validated['content'],
                'user_id' => Auth::id(),
            ]);

            // タグの関連付け
            if (!empty($validated['tags'])) {
                $blog->tags()->sync($validated['tags']);
            }

            return redirect()->route('blogs.index')->with('success', 'ブログが投稿されました');
        } catch (\Exception $e) {
            return back()->with('error', 'エラー: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->user_id != Auth::id()) {
            return redirect()->route('blog.show', ['id' => $blog->id])->with('error', '権限がありません');
        }

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'tags' => 'array|exists:tags,id', 
        ]);

        $blog->update($request->only(['title', 'content']));
        $blog->tags()->sync($request->tags);

        return redirect()->route('blog.show', ['id' => $blog->id])->with('success', 'ブログが更新されました');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->user_id != Auth::id()) {
            return redirect()->route('blogs.index')->with('error', '権限がありません');
        }

        $tags = Tag::all(); 
        return view('blogs.edit', compact('blog', 'tags'));
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->user_id != Auth::id()) {
            return redirect()->route('blogs.index')->with('error', '権限がありません');
        }

        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'ブログを削除しました');
    }
}