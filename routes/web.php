<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

// php artisan route:list --except-vendor
// See https://laracasts.com/series/30-days-to-learn-laravel-11/episodes/19
Route::view('/', 'home');
Route::view('/contact', 'contact');

Route::resource('jobs', JobController::class); //this one assumes all routes exist even if they don't

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
