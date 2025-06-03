<?php

namespace App\Entities\JobSeries\JobVisibilityStatus;

use App\Entities\JobSeries\JobVisibilityStatus\Traits\JobVisibilityStatusTrait;
use App\Enums\RouteNames\JobSeries\JobVisibilityStatusEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class JobVisibilityStatus extends BaseModel implements Transformable
{
    use JobVisibilityStatusTrait;

    protected $table = JobVisibilityStatusEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name'
    ];
}
