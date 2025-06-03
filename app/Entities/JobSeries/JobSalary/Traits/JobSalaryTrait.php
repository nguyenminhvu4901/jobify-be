<?php

namespace App\Entities\JobSeries\JobSalary\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait JobSalaryTrait
{
    use TransformableTrait, HasFactory, JobSalaryRelationship, JobSalaryScope;
}
