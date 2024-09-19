<?php

namespace App\Http\Controllers;

use App\Models\JobListing;

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

        JobListing::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1,
        ]);

        return redirect('/jobs');
    }

    public function edit(JobListing $job)
    {
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
