<?php

namespace App\Entities\JobSeries\JobModerationStatusLog;

use App\Entities\JobSeries\JobModerationStatusLog\Traits\JobModerationStatusLogRelationship;
use App\Enums\RouteNames\JobSeries\JobModerationStatusLogEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int $id
 * @property int $job_listing_id
 * @property int $job_moderation_status_id
 * @property string|null $note Comment chỉnh sửa
 * @property int|null $created_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Entities\JobSeries\JobListing\JobListing $jobListings
 * @property-read \App\Entities\JobSeries\JobModerationStatus\JobModerationStatus $jobModerationStatuses
 * @property-read \App\Models\User|null $users
 *
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatusLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatusLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatusLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatusLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatusLog whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatusLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatusLog whereJobListingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatusLog whereJobModerationStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatusLog whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobModerationStatusLog whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class JobModerationStatusLog extends BaseModel implements Transformable
{
    use HasFactory;
    use JobModerationStatusLogRelationship;
    use TransformableTrait;

    protected $table = JobModerationStatusLogEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'job_listing_id',
        'job_moderation_status_id',
        'note',
        'created_by',
    ];
}
