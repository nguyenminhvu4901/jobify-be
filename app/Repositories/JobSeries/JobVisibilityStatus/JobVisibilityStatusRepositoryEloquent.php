<?php

namespace App\Repositories\JobSeries\JobVisibilityStatus;

use App\Entities\JobSeries\JobVisibilityStatus\JobVisibilityStatus;
use App\Repositories\BaseRepository;

class JobVisibilityStatusRepositoryEloquent extends BaseRepository implements JobVisibilityStatusRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return JobVisibilityStatus::class;
    }
}
