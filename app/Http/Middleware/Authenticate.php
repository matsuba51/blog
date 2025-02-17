<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * リクエストを処理する前に実行される
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        // ユーザーが認証されていない場合
        if (Auth::guard($guard)->guest()) {
            // ログインページにリダイレクト
            return redirect()->route('login')->with('error', 'ログインが必要です');
        }

        // 認証されている場合はリクエストを次に渡す
        return $next($request);
    }
}