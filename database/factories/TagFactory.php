<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    // モデルを指定
    protected $model = Tag::class;

    /**
     * 定義するデータ
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,  // ランダムな単語を生成
        ];
    }
}