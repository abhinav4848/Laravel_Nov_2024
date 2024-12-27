<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\mail\JobPosted;

class JobController extends Controller
{
    // the following are called actions on a controller
    public function index()
    {
        //$jobs = Job::all(); //prevent N+1 database querying problem; when it's used in a context where each Job item requires additional data, especially if it's loading related models within a loop.
        //We can prevent lazy loading entirely in the application by going to Appserviceprovider.php and disabling it, so anytime any code in your application tries to lazy load anything, it'll give an error saying lazy loading is disabled so you can go back and tweak that code to make it only eager load.
        $jobs = Job::with('employer')->latest()->simplePaginate(3);
        //Paginate tells how many pages exist
        //simplePaginate saves on calculating how many pages there are- useful if many entries exist.
        //cursorPaginate makes url gibberish

        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);

    }

    public function store()
    {
        // validation
        request()->validate([
            'title' => ['required','min:3'],
            'salary' => ['required']
        ]);

        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        Mail::to($job->employer->user)->queue(new JobPosted($job));

        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        // if (Auth::user()->can('edit-job', $job)) {
        //     abort(403);
        // }

        // Gate::authorize('edit-job', $job); // Moved to policy

        // $job = Job::find($id);
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
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
    }

    public function destroy(Job $job)
    {
        // authorize

        // delete
        $job->delete();

        // Job::findOrFail($id)->delete(); // else there'd be a problem if the job didn't exist and find returned null then we called update on it. // not using this anymore as we're calling object Job

        //alternative
        // $job = Job::findOrFail($id)->delete();
        // $job->delete();

        //redirect
        return redirect('/jobs');
    }
}
