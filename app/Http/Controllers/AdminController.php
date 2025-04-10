<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        // 認証されていないユーザーはログインページにリダイレクト
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || !Auth::user()->isAdmin()) {
                return redirect('/blogs')->with('error', '管理者のみアクセス可能です');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $stats = Blog::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                    ->groupBy('date')
                    ->orderBy('date', 'DESC')
                    ->get();

        return view('admin.dashboard', compact('stats'));
    }

    public function blogs()
    {
        $blogs = Blog::with('user')->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.show', compact('blog'));
    }

    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function tags()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    public function dailyPosts()
    {
        // 日ごとの投稿数を取得
        $stats = Blog::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                     ->groupBy('date')
                     ->orderBy('date', 'DESC')
                     ->get();

        return view('admin.stats', compact('stats'));
    }
}