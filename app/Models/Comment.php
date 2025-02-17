<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // データベースで更新できるカラムを指定
    protected $fillable = [
        'body',
        'user_id',  // コメントしたユーザーID
        'blog_id',  // コメントが属するブログID
    ];

    // ユーザーとのリレーション（1対多）
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ブログとのリレーション（多対1）
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}