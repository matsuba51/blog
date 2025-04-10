<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog; 
use Carbon\Carbon;

class UpdateBlogDatesSeeder extends Seeder
{
    public function run()
    {
        // ランダムな日付を作成して 'created_at' を更新
        Blog::all()->each(function ($blog) {
            $randomDate = Carbon::now()->subDays(rand(1, 30)); // 1〜30日前の日付をランダムに生成
            $blog->created_at = $randomDate;  // 'created_at' を変更
            $blog->updated_at = $randomDate;  // 更新日も変更（必要に応じて）
            $blog->save();
        });
    }
}
