<?php

namespace App\Entities\JobSalary;

use App\Entities\JobSalary\Traits\JobSalaryRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobSalary extends Model implements Transformable
{
    use TransformableTrait, HasFactory, JobSalaryRelationship;

    protected $table = 'job_salaries';

    protected $fillable = [
        'currency_id',
        'job_salary_type_id',
        'from',
        'to'
    ];
}
