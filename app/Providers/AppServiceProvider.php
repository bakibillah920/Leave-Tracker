<?php

namespace App\Providers;

use App\Models\GlobalSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $globalConfig = new GlobalSetting();
        $this->app->singleton('global_config', function () use ($globalConfig) {
            return $globalConfig->first();
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $global_config = GlobalSetting::first();
        View::share('global_config', $global_config);
    }
}
