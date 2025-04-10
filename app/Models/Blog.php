<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id', 
    ];

    /**
     * ブログを投稿したユーザーとのリレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class);  // BlogはUserに属している
    }

    /**
     * ブログのコメント一覧を取得
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);  // `Comment` モデルとの1対多のリレーション
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tag');
    }
}