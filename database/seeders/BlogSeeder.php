<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\User;
use App\Models\Tag;

class BlogSeeder extends Seeder
{
    public function run()
    {
        // 既存のタグを取得（タグがない場合は作成）
        $tags = Tag::all();
        if ($tags->isEmpty()) {
            Tag::factory(5)->create(); // タグがなければ5個作成
            $tags = Tag::all(); // 作成後に取得
        }

        // 30個のブログを作成し、それぞれにタグをランダムに付与
        Blog::factory(30)->create()->each(function ($blog) use ($tags) {
            $randomTags = $tags->random(rand(1, 3))->pluck('id'); // ランダムで1〜3個のタグを取得
            $blog->tags()->attach($randomTags); // タグをブログに関連付け
        });
    }
}