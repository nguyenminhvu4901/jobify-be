<?php

namespace App\Repositories\JobSeries\JobAgeRange;

use App\Entities\JobSeries\JobAgeRange\JobAgeRange;
use App\Repositories\BaseRepository;

class JobAgeRangeRepositoryEloquent extends BaseRepository implements JobAgeRangeRepository
{
    public function model(): string
    {
        return JobAgeRange::class;
    }
}
