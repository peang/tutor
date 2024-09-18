<?php

use App\Models\Job;
use App\Models\JobListing;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('home');
});

Route::get('/jobs', function () {
  $jobs = JobListing::with('employer')->simplePaginate(5);

  return view('jobs', [
    'jobs' => $jobs,
  ]);
});

Route::get('/jobs/{id}', function ($id) {
  $job = JobListing::find($id);

  if (!$job) {
    abort(404);
  }

  return view('job', [
    'job' => $job
  ]);
});

Route::get('/about', function () {
  return view('about');
});

Route::get('/contact', function () {
  return view('contact');
});
