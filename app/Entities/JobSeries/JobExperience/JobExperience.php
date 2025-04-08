<?php

namespace App\Entities\JobSeries\JobExperience;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobExperience extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'job_experiences';

    public const FILLABLE_FIELDS = [
        'name'
    ];
}
