<?php

namespace App\Repositories\JobSeries\JobListingDetail;

interface JobListingDetailRepository
{
    public function getFirstByJobListingId(int $jobListingId);
}
