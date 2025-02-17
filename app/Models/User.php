<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // ユーザーが投稿したブログとのリレーション（1対多）
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    // ユーザーが投稿したコメントとのリレーション（1対多）
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}