<?php

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

// Show
Route::get('/jobs/{id}', function ($id) {
    $job = JobListing::find($id);

    if (!$job) {
        abort(404);
    }

    return view('jobs.show', [
        'job' => $job
    ]);
});


// Store
Route::post('/jobs', function () {
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
});

// Edit
Route::get('/jobs/{id}/edit', function () {
    $job = JobListing::find(request('id'));

    return view('jobs.edit', [
        'job' => $job
    ]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
    request()->validate([
        'title' => ['required', 'min: 3'],
        'salary' => ['required'],
    ]);

    $job = JobListing::findOrFail($id);

    $job->update([
        'title' => request('title'),
        'salary' => request('salary'),
    ]);

    return redirect('/jobs/' . $job->id);
});

// Delete
Route::delete('/jobs/{id}', function ($id) {
    JobListing::findOrFail($id)->delete();

    return redirect('/jobs');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});
