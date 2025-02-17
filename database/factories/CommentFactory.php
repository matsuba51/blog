<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'body' => $this->faker->sentence(),
            'user_id' => User::factory(),  // コメントするユーザーを生成
            'blog_id' => Blog::factory(),  // コメントが関連するブログを生成
        ];
    }
}
