<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    //$jobs = Job::all(); //prevent N+1 database querying problem; when it's used in a context where each Job item requires additional data, especially if it's loading related models within a loop.
    //We can prevent lazy loading entirely in the application by going to Appserviceprovider.php and disabling it, so anytime any code in your application tries to lazy load anything, it'll give an error saying lazy loading is disabled so you can go back and tweak that code to make it only eager load.
    $jobs = Job::with('employer')->get();

    return view('jobs', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});
