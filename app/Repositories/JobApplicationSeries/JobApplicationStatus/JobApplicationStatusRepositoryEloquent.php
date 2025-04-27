<?php

namespace App\Repositories\JobApplicationSeries\JobApplicationStatus;

use App\Entities\JobApplicationSeries\JobApplicationStatus\JobApplicationStatus;
use App\Repositories\BaseRepository;

class JobApplicationStatusRepositoryEloquent extends BaseRepository implements JobApplicationStatusRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return JobApplicationStatus::class;
    }
}
