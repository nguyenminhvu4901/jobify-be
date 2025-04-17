<?php

namespace App\Entities\JobSeries\JobPosition;

use App\Entities\JobSeries\JobPosition\Traits\JobPositionRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobPosition extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobPositionRelationship;

    protected $table = 'job_position';

    public const FILLABLE_FIELDS = [
        'job_listing_id',
        'position_id',
        'priority'
    ];
}
