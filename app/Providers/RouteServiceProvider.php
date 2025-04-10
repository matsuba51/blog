<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * 一般的なコントローラーの名前空間を定義
     *
     * @var string
     */
    public const HOME = '/blogs';

    /**
     * 一般的なコントローラーの名前空間を定義
     * 
     * @var string
     */
    protected $namespace = 'App\\Http\\Controllers';

    /**
     * すべてのルートの登録を行う
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * ルートの登録を行う
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();
        $this->mapApiRoutes();
    }

    /**
     * Webのルートを定義
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * APIのルートを定義
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}