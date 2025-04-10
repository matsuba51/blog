<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;  // Userモデルをインポート

class PostSeeder extends Seeder
{
    public function run()
    {
        // 最初のユーザーを取得
        $user = User::first();  // 最初のユーザーのIDを取得

        if ($user) {
            Post::create([
                'title' => 'サンプル投稿1',
                'content' => 'これはサンプルの投稿です。',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
                'user_id' => $user->id,  // 最初のユーザーのIDを指定
            ]);

            Post::create([
                'title' => 'サンプル投稿2',
                'content' => 'これは別のサンプル投稿です。',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
                'user_id' => $user->id,  // 最初のユーザーのIDを指定
            ]);

            Post::create([
                'title' => 'サンプル投稿3',
                'content' => 'さらに別のサンプル投稿です。',
                'created_at' => now()->subDay(),
                'updated_at' => now()->subDay(),
                'user_id' => $user->id,  // 最初のユーザーのIDを指定
            ]);
        } else {
            // ユーザーが存在しない場合のエラーハンドリング
            echo "ユーザーが見つかりませんでした。\n";
        }
    }
}
