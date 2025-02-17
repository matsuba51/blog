<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // BlogSeeder と CommentSeeder を実行
        $this->call([
            BlogSeeder::class,
            CommentSeeder::class,
            TagSeeder::class,
        ]);
    }
}