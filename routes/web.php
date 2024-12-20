<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

// Display all jobs
Route::get('/jobs', function () {
    //$jobs = Job::all(); //prevent N+1 database querying problem; when it's used in a context where each Job item requires additional data, especially if it's loading related models within a loop.
    //We can prevent lazy loading entirely in the application by going to Appserviceprovider.php and disabling it, so anytime any code in your application tries to lazy load anything, it'll give an error saying lazy loading is disabled so you can go back and tweak that code to make it only eager load.
    $jobs = Job::with('employer')->latest()->simplePaginate(3);
    //Paginate tells how many pages exist
    //simplePaginate saves on calculating how many pages there are- useful if many entries exist.
    //cursorPaginate makes url gibberish

    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

// Page to create a job
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

// Shows a job. Since it's a wildcard, it's at the bottom of all jobs::GET routes
// Wildcard routes should be at the bottom
Route::get('/jobs/{job}', function (Job $job) {
    // for laravel to interpret it as an ID, wildcard and parameter name to be identical because that is interpreted as {job:id}
    // now it can just be job. See: https://laracasts.com/series/30-days-to-learn-laravel-11/episodes/19
    // $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);

});

// Persist a job in the database
Route::post('/jobs', function () {
    // validation
    request()->validate([
        'title' => ['required','min:3'],
        'salary' => ['required']
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// Edit a job
Route::get('/jobs/{job}/edit', function (Job $job) {
    // $job = Job::find($id);
    return view('jobs.edit', ['job' => $job]);
});

//Update a job
Route::patch('/jobs/{job}', function (Job $job) {
    // authorize (on hold...)

    //validate
    request()->validate([
        'title' => ['required','min:3'],
        'salary' => ['required']
    ]);

    //get the job to update
    // $job = Job::findOrFail($id); // else there'd be a problem if the job didn't exist and find returned null then we called update on it.

    //update the job
    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    // Same as the update method
    // $job->title = request('title');
    // $job->salary = request('salary');
    // $job->save();

    //redirect to the job page
    return redirect('/jobs/'.$job->id);
});

// Destroy
Route::delete('/jobs/{job}', function (Job $job) {
    // authorize

    // delete
    $job->delete();

    // Job::findOrFail($id)->delete(); // else there'd be a problem if the job didn't exist and find returned null then we called update on it. // not using this anymore as we're calling object Job

    //alternative
    // $job = Job::findOrFail($id)->delete();
    // $job->delete();

    //redirect
    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});
