<?php

namespace App\Entities\JobSeries\JobType;

use App\Entities\JobSeries\JobType\Traits\JobTypeRelationShip;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobType extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobTypeRelationShip;

    protected $table = 'job_types';

    public const FILLABLE_FIELDS = [
        'type'
    ];
}
