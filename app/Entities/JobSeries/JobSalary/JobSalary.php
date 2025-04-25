<?php

namespace App\Entities\JobSeries\JobSalary;

use App\Entities\JobSeries\JobSalary\Traits\JobSalaryRelationship;
use App\Entities\JobSeries\JobSalary\Traits\JobSalaryScope;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobSalary extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobSalaryRelationship, JobSalaryScope;

    protected $table = 'job_salary';

    public const FILLABLE_FIELDS = [
        'job_listing_id',
        'salary_id'
    ];
}
