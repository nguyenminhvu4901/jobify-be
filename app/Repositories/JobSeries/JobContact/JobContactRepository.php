<?php

namespace App\Repositories\JobSeries\JobContact;

interface JobContactRepository
{
    public function getJobContactIdsByJobListingId(int $jobContactId);
}
