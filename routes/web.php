<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;

// php artisan route:list --except-vendor
// See https://laracasts.com/series/30-days-to-learn-laravel-11/episodes/19
Route::view('/', 'home');
Route::view('/contact', 'contact');

Route::resource('jobs', JobController::class); //this one assumes all routes exist even if they don't

//customize the above with only or except based on what routes you actually have
// Route::resource('jobs', JobController::class, [
//     'only' => ['index', 'show', 'edit']
// ]);

// Otherwise go verbose
// Route::controller(JobController::class)->group(function () {
//     Route::get('/jobs', 'index');
//     Route::get('/jobs/create', 'create');
//     Route::get('/jobs/{job}', 'show');
//     Route::post('/jobs', 'store');
//     Route::get('/jobs/{job}/edit', 'edit');
//     Route::patch('/jobs/{job}', 'update');
//     Route::delete('/jobs/{job}', 'destroy');
// });


// Route::get('/jobs', [JobController::class, 'index']);
// Route::get('/jobs/create', [JobController::class, 'create']);
// Route::get('/jobs/{job}', [JobController::class, 'show']);
// Route::post('/jobs', [JobController::class, 'store']);
// Route::get('/jobs/{job}/edit', [JobController::class, 'edit']);
// Route::patch('/jobs/{job}', [JobController::class, 'update']);
// Route::delete('/jobs/{job}', [JobController::class, 'destroy']);
