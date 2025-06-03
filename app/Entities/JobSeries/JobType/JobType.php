<?php

namespace App\Entities\JobSeries\JobType;

use App\Entities\JobSeries\JobType\Traits\JobTypeTrait;
use App\Enums\RouteNames\JobSeries\JobTypeEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
class JobType extends BaseModel implements Transformable
{
    use JobTypeTrait;

    protected $table = JobTypeEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'type'
    ];


}
