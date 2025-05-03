<?php

namespace App\Repositories\JobSeries\JobEducationLevel;

use App\Entities\JobSeries\JobEducationLevel\JobEducationLevel;
use App\Repositories\BaseRepository;

class JobEducationLevelRepositoryEloquent extends BaseRepository implements JobEducationLevelRepository
{
    public function model(): string
    {
        return JobEducationLevel::class;
    }
}
