<?php

namespace App\Entities\JobSeries\JobAgeRange;

use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobAgeRange extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'job_age_ranges';

    public const FILLABLE_FIELDS = [
        'min_age',
        'max_age'
    ];
}
