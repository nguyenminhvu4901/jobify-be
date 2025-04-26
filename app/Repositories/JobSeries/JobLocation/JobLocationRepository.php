<?php

namespace App\Repositories\JobSeries\JobLocation;

interface JobLocationRepository
{
    public function getJobLocationIdsByJobListingId(int $jobListingId);
}
