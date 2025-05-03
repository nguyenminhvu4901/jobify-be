<?php

namespace App\Repositories\JobSeries\JobLocation;

use App\Entities\JobSeries\JobLocation\JobLocation;
use App\Repositories\BaseRepository;

class JobLocationRepositoryEloquent extends BaseRepository implements JobLocationRepository
{
    public function model(): string
    {
        return JobLocation::class;
    }

    public function getJobLocationIdsByJobListingId(int $jobListingId): mixed
    {
        return $this->model->whereByJobListingId($jobListingId)->pluck('id')->values();
    }
}
