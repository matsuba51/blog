<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login'); // ログインしていなければログインページへリダイレクト
        }

        if (intval(Auth::user()->is_admin) !== 1) {
            abort(403, '管理者専用のページです');
        }

        return $next($request);
    }
}