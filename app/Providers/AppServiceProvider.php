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
        $this->app->bind('App\Repositories\Interfaces\StudentRepositoryInterface', 'App\Repositories\StudentRepository');
        $this->app->bind('App\Repositories\Interfaces\UniversityRepositoryInterface', 'App\Repositories\UniversityRepository');
        $this->app->bind('App\Repositories\Interfaces\SubjectRepositoryInterface', 'App\Repositories\SubjectRepository');
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
