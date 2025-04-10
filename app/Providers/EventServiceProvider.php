<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendWelcomeEmail;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * アプリケーションのイベントリスナーのマッピング
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendWelcomeEmail::class,  // 新規登録時にウェルカムメールを送るリスナー
        ],
    ];

    /**
     * アプリケーションのイベントサービスの起動
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
