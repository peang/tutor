<?php

namespace App\Jobs;

use App\Mail\JobPosted;
use App\Models\JobListing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Mail;

class TranslateJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public JobListing $jobListing)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // logger(sprintf("New Job %s Has Been Created", $this->jobListing->title));

        Mail::to($this->jobListing->employer->user)->send(new JobPosted($this->jobListing));
    }
}
