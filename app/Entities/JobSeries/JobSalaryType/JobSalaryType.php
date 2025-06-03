<?php

namespace App\Entities\JobSeries\JobSalaryType;

use App\Entities\JobSeries\JobSalaryType\Traits\JobSalaryTypeTrait;
use App\Enums\RouteNames\JobSeries\JobSalaryTypeEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class JobSalaryType extends BaseModel implements Transformable
{
    use JobSalaryTypeTrait;

    protected $table = JobSalaryTypeEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'type'
    ];


}
