<?php

namespace App\Repositories\JobApplicationSeries\JobApplication;

use App\Entities\JobApplicationSeries\JobApplication\JobApplication;
use App\Repositories\BaseRepository;

class JobApplicationRepositoryEloquent extends BaseRepository implements JobApplicationRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return JobApplication::class;
    }
}
