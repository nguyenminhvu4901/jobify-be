<?php

namespace App\Entities\JobSeries\JobModerationStatusLog;

use App\Entities\JobSeries\JobModerationStatusLog\Traits\JobModerationStatusLogRelationship;
use App\Enums\RouteNames\JobSeries\JobModerationStatusLogEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobModerationStatusLog extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobModerationStatusLogRelationship;

    protected $table = JobModerationStatusLogEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'job_listing_id',
        'job_moderation_status_id',
        'note',
        'created_by'
    ];
}
