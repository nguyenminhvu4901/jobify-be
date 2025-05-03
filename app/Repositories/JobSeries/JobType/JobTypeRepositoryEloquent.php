<?php

namespace App\Repositories\JobSeries\JobType;

use App\Entities\JobSeries\JobType\JobType;
use App\Repositories\BaseRepository;

class JobTypeRepositoryEloquent extends BaseRepository implements JobTypeRepository
{
    public function model(): string
    {
        return JobType::class;
    }
}
