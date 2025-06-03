<?php

namespace App\Entities\JobSeries\JobSalary;

use App\Entities\JobSeries\JobSalary\Traits\JobSalaryTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class JobSalary extends BaseModel implements Transformable
{
    use JobSalaryTrait;

    protected $table = 'job_salaries';

    public const FILLABLE_FIELDS = [
        'job_listing_id',
        'currency_id',
        'job_salary_type_id',
        'from',
        'to'
    ];
}
