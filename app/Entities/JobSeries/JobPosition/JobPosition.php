<?php

namespace App\Entities\JobSeries\JobPosition;

use App\Entities\JobSeries\JobPosition\Traits\JobPositionTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class JobPosition extends BaseModel implements Transformable
{
    use JobPositionTrait;

    protected $table = 'job_position';

    public const FILLABLE_FIELDS = [
        'job_listing_id',
        'position_id',
        'priority'
    ];
}
