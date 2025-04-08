<?php

namespace App\Entities\JobSeries\JobLevel;

use App\Entities\JobSeries\JobLevel\Traits\JobLevelRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobLevel extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobLevelRelationship;

    protected $table = 'job_levels';

    public const FILLABLE_FIELDS = [
        'title', 'description'
    ];
}
