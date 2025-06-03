<?php

namespace App\Entities\JobSeries\JobModerationStatusLog;

use App\Entities\JobSeries\JobModerationStatus\Traits\JobModerationStatusTrait;
use App\Enums\RouteNames\JobSeries\JobModerationStatusLogEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class JobModerationStatusLog extends BaseModel implements Transformable
{
    use JobModerationStatusTrait;

    protected $table = JobModerationStatusLogEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'job_listing_id',
        'job_moderation_status_id',
        'note',
        'created_by'
    ];
}
