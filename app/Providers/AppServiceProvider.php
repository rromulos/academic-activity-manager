<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('App\Services\Interfaces\ActivityServiceInterface', 'App\Services\ActivityService');
        $this->app->singleton('App\Services\Interfaces\BillingServiceInterface', 'App\Services\BillingService');

        $this->app->bind('App\Repositories\Interfaces\ActivityRepositoryInterface','App\Repositories\ActivityRepository');
        $this->app->bind('App\Repositories\Interfaces\BillingRepositoryInterface', 'App\Repositories\BillingRepository');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
