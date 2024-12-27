<?php

use App\Models\Job;
use App\Jobs\TranslateJob;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisteredUserController;

Route::get('test', function () {
    // queued closure
    // dispatch(function () {
    //     logger('hello from the queue!');
    // })->delay(5);

    // dispatch a dedicated job instead
    $job = Job::first();
    TranslateJob::dispatch($job);

    return 'Done';
});

// php artisan route:list --except-vendor
// See https://laracasts.com/series/30-days-to-learn-laravel-11/episodes/19
Route::view('/', 'home');
Route::view('/contact', 'contact');

// Route::resource assumes all routes exist even if they don't
// if not authenticated, the middleware redirects to the route with the name 'login'
Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
Route::get('/jobs/{job}', [JobController::class, 'show']);

Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'job'); // edit is name of the gate and job is passind it the current variable

Route::patch('/jobs/{job}', [JobController::class, 'update'])
    ->middleware('auth')
    ->can('edit', 'job');

Route::delete('/jobs/{job}', [JobController::class, 'destroy'])
    ->middleware('auth')
    ->can('edit', 'job');

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
