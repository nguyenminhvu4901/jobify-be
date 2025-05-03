<?php

namespace App\Repositories\JobSeries\JobExperience;

use App\Entities\JobSeries\JobExperience\JobExperience;
use App\Repositories\BaseRepository;

class JobExperienceRepositoryEloquent extends BaseRepository implements JobExperienceRepository
{
    public function model(): string
    {
        return JobExperience::class;
    }
}
