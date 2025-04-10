<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\User;
use App\Models\Blog;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'content' => $this->faker->sentence(), // ランダムなコメント内容
            'user_id' => User::factory(), // ランダムなユーザー
            'blog_id' => Blog::factory(), // ランダムなブログ
        ];
    }
}
