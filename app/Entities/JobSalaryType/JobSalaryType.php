<?php

namespace App\Entities\JobSalaryType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobSalaryType extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'job_salary_types';

    protected $fillable = ['type'];
}
