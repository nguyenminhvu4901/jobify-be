<?php

namespace App\Repositories\JobSeries\JobLevel;

use App\Entities\JobSeries\JobLevel\JobLevel;
use App\Repositories\BaseRepository;

class JobLevelRepositoryEloquent extends BaseRepository implements JobLevelRepository
{
    public function model(): string
    {
        return JobLevel::class;
    }
}
