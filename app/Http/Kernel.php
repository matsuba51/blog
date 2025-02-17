<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Http\Middleware\TrustProxies;
use App\Http\Middleware\RedirectIfAuthenticated;

class Kernel extends HttpKernel
{
    /**
     * グローバル HTTP ミドルウェアスタック
     *
     * すべてのリクエストに適用されるミドルウェアを指定します。
     *
     * @var array
     */
    protected $middleware = [
        // データをクリーンにするために必要なミドルウェアなど
        \Illuminate\Http\Middleware\HandleCors::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \Illuminate\Session\Middleware\StartSession::class,  // セッション開始
        \Illuminate\Routing\Middleware\SubstituteBindings::class,  // ルートパラメータのバインディング
    ];

    /**
     * ルートミドルウェア
     *
     * 特定のルートに適用するミドルウェアを指定します。
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Authenticate::class,  // 認証ミドルウェア
        'guest' => RedirectIfAuthenticated::class,  // ゲストユーザーをログインページにリダイレクト
        'throttle' => ThrottleRequests::class,  // リクエスト制限
        'bindings' => SubstituteBindings::class,  // ルートパラメータのバインディング
    ];

    /**
     * グローバル HTTP ミドルウェアスタックの追加
     *
     * 必要な場合、グローバルミドルウェアを変更することができます。
     * ここにリストされていないミドルウェアは、個々のルートで指定する必要があります。
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];
}