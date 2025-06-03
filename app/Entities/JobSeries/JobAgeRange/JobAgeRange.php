<?php

namespace App\Entities\JobSeries\JobAgeRange;

use App\Entities\JobSeries\JobAgeRange\Traits\JobAgeRangeTrait;
use App\Enums\RouteNames\JobSeries\JobAgeRangeEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class JobAgeRange extends BaseModel implements Transformable
{
    use JobAgeRangeTrait;

    protected $table = JobAgeRangeEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'min_age',
        'max_age'
    ];
}
