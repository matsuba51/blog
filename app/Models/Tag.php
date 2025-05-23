<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name']; 

    // ブログとのリレーション
    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }
}