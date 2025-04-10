<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Blog;
use App\Models\User;

class CommentSeeder extends Seeder
{
    public function run()
    {
        // 任意のブログを取得
        $blogs = Blog::all();
        $users = User::all();

        if ($blogs->isEmpty() || $users->isEmpty()) {
            return; // ブログやユーザーがない場合は何もしない
        }

        foreach ($blogs as $blog) {
            // 各ブログに3つのダミーコメントを追加
            Comment::factory()->count(3)->create([
                'blog_id' => $blog->id,
                'user_id' => $users->random()->id, // ランダムなユーザーを紐付け
            ]);
        }
    }
}
