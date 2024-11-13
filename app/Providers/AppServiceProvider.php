<?php

namespace App\Providers;

use Illuminate\database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading();

        // export the pagination styles via php artisan vendor:publish and choose laravel-pagination
        // Paginator::useBootstrapFive(); //default is tailwind.
    }
}
