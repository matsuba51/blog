<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * CSRFトークンの検証を除外するルート
     *
     * @var array<int, string>
     */
    protected $except = [
        // ここに除外するルートがあれば記述（通常は空でOK）
    ];
}
