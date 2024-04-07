<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class QrCodeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('qrCode', function () {
        return new \App\Libraries\QrCode();
    });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
