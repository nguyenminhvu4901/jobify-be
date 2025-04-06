<?php

namespace App\Entities\JobSeries\JobSalaryType;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobSalaryType extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'job_salary_types';

    public const FILLABLE_FIELDS = [
        'type'
    ];
}
