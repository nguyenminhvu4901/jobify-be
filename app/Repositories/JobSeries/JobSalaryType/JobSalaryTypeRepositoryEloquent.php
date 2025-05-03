<?php

namespace App\Repositories\JobSeries\JobSalaryType;

use App\Entities\JobSeries\JobSalaryType\JobSalaryType;
use App\Repositories\BaseRepository;

class JobSalaryTypeRepositoryEloquent extends BaseRepository implements JobSalaryTypeRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return JobSalaryType::class;
    }
}
