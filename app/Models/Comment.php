<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'user_id', 'blog_id'];

    /**
     * コメントを投稿したユーザーとのリレーション
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * コメントが紐づくブログとのリレーション
     */
    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }
}
