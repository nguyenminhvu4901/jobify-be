<?php

namespace App\Entities\JobSeries\Salary;

use App\Entities\JobSeries\Salary\Traits\SalaryRelationship;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salary extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, SalaryRelationship;

    protected $table = 'salaries';

    public const FILLABLE_FIELDS = [
        'currency_id',
        'job_salary_type_id',
        'from',
        'to'
    ];
}
