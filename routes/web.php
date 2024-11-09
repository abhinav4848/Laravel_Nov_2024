<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

$jobs = [
    [
        'id' => 1,
        'title' => 'Director',
        'salary' => '$50000'
    ],
    [
        'id' => 2,
        'title' => 'Programmer',
        'salary' => '$10000'
    ],
    [
        'id' => 3,
        'title' => 'Teacher',
        'salary' => '$40000'
    ]
];

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () use ($jobs) {
    return view('jobs', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/{id}', function ($id) use ($jobs) {
    $jobs = $jobs;
    $job = Arr::first($jobs, fn ($job) => $job['id'] == $id);
    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});