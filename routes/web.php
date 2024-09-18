<?php

use App\Models\Job;
use App\Models\JobListing;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/jobs', function () {
    $jobs = JobListing::with('employer')->latest()->simplePaginate(5);

    return view('jobs.index', [
        'jobs' => $jobs,
    ]);
});

Route::get('/jobs/create', function () {
    return view('jobs.create');
});

Route::get('/jobs/{id}', function ($id) {
    $job = JobListing::find($id);

    if (!$job) {
        abort(404);
    }

    return view('jobs.show', [
        'job' => $job
    ]);
});

Route::post('/jobs', function () {
    // dd(request()->all());

    JobListing::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1,
    ]);

    return redirect('/jobs');
});


Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});
