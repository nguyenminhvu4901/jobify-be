<?php

namespace App\Entities\JobSeries\JobEducationLevel;

use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobEducationLevel extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'job_education_level';

    public const FILLABLE_FIELDS = ['name'];
}
