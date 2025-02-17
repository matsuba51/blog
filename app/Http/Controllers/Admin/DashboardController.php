<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Admin フォルダの Controller を継承
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\User;
use App\Models\Tag;

class DashboardController extends Controller
{
    public function index()
    {
        // ログインユーザー情報を取得
        $user = Auth::user();

        // 日ごとの投稿数
        $dailyPosts = Blog::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                          ->groupBy('date')
                          ->orderBy('date', 'desc')
                          ->get();

        // 最新のブログ一覧（数件取得）
        $blogs = Blog::latest()->take(5)->get();

        // ユーザー一覧
        $users = User::all();

        // タグ一覧
        $tags = Tag::all();

        // ダッシュボードビューへデータを渡す
        return view('admin.dashboard', compact('user', 'dailyPosts', 'blogs', 'users', 'tags'));
    }
}
