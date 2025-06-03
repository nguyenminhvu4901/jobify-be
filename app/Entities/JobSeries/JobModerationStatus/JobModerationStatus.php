<?php

namespace App\Entities\JobSeries\JobModerationStatus;

use App\Entities\JobSeries\JobModerationStatus\Traits\JobModerationStatusTrait;
use App\Enums\RouteNames\JobSeries\JobModerationStatusEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class JobModerationStatus extends BaseModel implements Transformable
{
    use JobModerationStatusTrait;

    protected $table = JobModerationStatusEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'name'
    ];
}
