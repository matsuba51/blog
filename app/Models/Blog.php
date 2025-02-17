<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    // データベースで更新できるカラムを指定
    protected $fillable = [
        'title',
        'body',
        'user_id',  // 投稿者のID
    ];

    // ユーザーとのリレーション（1対多）
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // コメントとのリレーション（1対多）
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // 削除時にコメントも削除
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($blog) {
            $blog->comments()->delete();
        });
    }
}
