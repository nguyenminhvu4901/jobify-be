<?php

namespace App\Entities\JobSeries\JobLevel;

use App\Entities\JobSeries\JobLevel\Traits\JobLevelTrait;
use App\Enums\RouteNames\JobSeries\JobLevelEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class JobLevel extends BaseModel implements Transformable
{
    use JobLevelTrait;

    protected $table = JobLevelEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'title', 'description'
    ];
}
