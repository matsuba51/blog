<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * ハンドルされたリクエストを処理します。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // 認証済みのユーザーがアクセスしてきた場合、リダイレクトする
        if (Auth::check()) {
            // 通常はホームページやダッシュボードページにリダイレクト
            return redirect('/home');
        }

        return $next($request);
    }
}
