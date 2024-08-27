<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Setting;
use App\Services\PayWayService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(PayWayService::class, function ($app) {
            return new PayWayService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        
        Paginator::useBootstrapFour();

        $setting_data = Setting::where('id',1)->first();

        view()->share('global_setting_data', $setting_data);

    }
}
