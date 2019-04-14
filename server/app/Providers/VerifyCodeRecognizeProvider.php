<?php

namespace App\Providers;

use App\Contracts\VerifyCodeRecognizeInterface;
use App\Services\VerifyCodeRecognizer;
use Illuminate\Support\ServiceProvider;

class VerifyCodeRecognizeProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(VerifyCodeRecognizeInterface::class, VerifyCodeRecognizer::class);
    }

    // 设置defer是true的时候需要 实现这个方法
    public function provides()
    {
        return [
            VerifyCodeRecognizeInterface::class,
        ];
    }
}
