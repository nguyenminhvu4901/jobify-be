<?php

namespace App\Repositories\JobSeries\JobListing;

use App\Entities\JobSeries\JobListing\JobListing;
use App\Repositories\BaseRepository;

class JobListingRepositoryEloquent extends BaseRepository implements JobListingRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return JobListing::class;
    }
}
