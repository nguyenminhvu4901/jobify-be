<?php

namespace App\Commands\JobSeries\JobListing\StoreJob;

use App\Repositories\JobSeries\JobListing\JobListingRepository;

class StoreJobHandler
{
    public function __construct(
        JobListingRepository $jobListingRepository
    )
    {
    }

    public function handle(StoreJobCommand $command)
    {
        foreach ($command->jobLocations as $jobLocation){
            dd($jobLocation);
        }
        dd(($command->jobLocations));
    }
}
