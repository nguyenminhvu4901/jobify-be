<?php

namespace App\Repositories\JobSeries\Salary;

use App\Entities\JobSeries\Salary\Salary;
use App\Repositories\BaseRepository;

class SalaryRepositoryEloquent extends BaseRepository implements SalaryRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return Salary::class;
    }
}
