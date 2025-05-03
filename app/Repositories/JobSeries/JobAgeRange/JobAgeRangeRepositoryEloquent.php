<?php

namespace App\Repositories\JobSeries\JobAgeRange;

use App\Entities\JobSeries\JobAgeRange\JobAgeRange;
use App\Repositories\BaseRepository;

class JobAgeRangeRepositoryEloquent extends BaseRepository implements JobAgeRangeRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return JobAgeRange::class;
    }
}
