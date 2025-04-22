<?php

namespace App\Repositories\JobSeries\JobSalary;

use App\Entities\JobSeries\JobSalary\JobSalary;
use App\Repositories\BaseRepository;

class JobSalaryRepositoryEloquent extends BaseRepository implements JobSalaryRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return JobSalary::class;
    }
}
