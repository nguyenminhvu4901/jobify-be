<?php

namespace App\Entities\JobSeries\JobEducationLevel;

use App\Entities\JobSeries\JobEducationLevel\Traits\JobEducationLevelTrait;
use App\Enums\RouteNames\JobSeries\JobEducationLevelEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class JobEducationLevel extends BaseModel implements Transformable
{
    use JobEducationLevelTrait;

    protected $table = JobEducationLevelEnum::TABLE->value;

    public const FILLABLE_FIELDS = ['name'];
}
