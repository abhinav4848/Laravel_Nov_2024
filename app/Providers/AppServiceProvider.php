<?php

namespace App\Providers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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

        // Moved to JobPolicy
        // Gate::define('edit-job', function (User $user, Job $job) {
        //     // see if the user responsible for the job is the same as the user currently signed in.
        //     return $job->employer->user->is($user);
        // });
    }
}
