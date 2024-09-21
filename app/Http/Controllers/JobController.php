<?php

namespace App\Http\Controllers;

use App\Jobs\TranslateJob;
use App\Mail\JobPosted;
use App\Models\JobListing;
use Illuminate\Support\Facades\Gate;
use Mail;

class JobController extends Controller
{
    public function index()
    {
        $jobs = JobListing::with('employer')->latest()->simplePaginate(5);

        return view('jobs.index', [
            'jobs' => $jobs,
        ]);
    }

    public function show(JobListing $job)
    {
        return view('jobs.show', [
            'job' => $job
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'min: 3'],
            'salary' => ['required'],
        ]);

        $job = JobListing::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1,
        ]);

        // Mail::to($job->employer->user)->queue(new JobPosted($job));
        TranslateJob::dispatch($job);

        return redirect('/jobs');
    }

    public function edit(JobListing $job)
    {
        Gate::authorize('edit-job', $job);

        return view('jobs.edit', [
            'job' => $job
        ]);
    }

    public function patch(JobListing $job)
    {
        request()->validate([
            'title' => ['required', 'min: 3'],
            'salary' => ['required'],
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        return redirect('/jobs/' . $job->id);
    }

    public function destroy(JobListing $job)
    {
        $job->delete();

        return redirect('/jobs');
    }
}
