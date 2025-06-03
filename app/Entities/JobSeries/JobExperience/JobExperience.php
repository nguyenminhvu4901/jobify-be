<?php

namespace App\Entities\JobSeries\JobExperience;

use App\Entities\JobSeries\JobExperience\Traits\JobExperienceTrait;
use App\Enums\RouteNames\JobSeries\JobExperienceEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class JobExperience extends BaseModel implements Transformable
{
    use JobExperienceTrait;

    protected $table = JobExperienceEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name'
    ];
}
