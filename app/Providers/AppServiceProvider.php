<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\ActivityServiceInterface;
use App\Services\ActivityService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Services
         */
        //$this->app->singleton('App\Services\Interfaces\ActivityServiceInterface', 'App\Services\ActivityService');
        $this->app->singleton(ActivityServiceInterface::class, ActivityService::class);

        /**
         * Repositories
         */
        $this->app->bind('App\Repositories\Interfaces\ActivityRepositoryInterface','App\Repositories\ActivityRepository');
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
