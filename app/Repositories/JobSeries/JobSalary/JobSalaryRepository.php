<?php

namespace App\Repositories\JobSeries\JobSalary;

interface JobSalaryRepository
{
    public function getJobSalaryIdsByJobListingId(int $jobListingId);

    public function detachJobSalary(int $jobListingId, array $jobSalaryIds);
}
