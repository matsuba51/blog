<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ファクトリーでダミーデータを生成
        \App\Models\Tag::factory(10)->create();  // 10件のダミーデータを作成
    }
}