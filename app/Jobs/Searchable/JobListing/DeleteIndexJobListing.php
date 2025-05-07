<?php

namespace App\Jobs\Searchable\JobListing;

use App\Entities\JobSeries\JobListing\JobListing;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class DeleteIndexJobListing implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected JobListing $jobListing
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->jobListing->removeAllFromSearch();
    }

    /**
     * The number of seconds after which the job's unique lock will be released.
     *
     * @var int
     */
    public int $uniqueFor = 60;

    /**
     * Get the unique ID for the job.
     */
    public function uniqueId(): string
    {
        return $this->jobListing->id;
    }
}
