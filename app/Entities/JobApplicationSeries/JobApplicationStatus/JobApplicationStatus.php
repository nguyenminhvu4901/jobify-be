<?php

namespace App\Entities\JobApplicationSeries\JobApplicationStatus;

use App\Entities\JobApplicationSeries\JobApplicationStatus\Traits\JobApplicationStatusRelationship;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property-read \App\Entities\JobApplicationSeries\ApplicationStatus\ApplicationStatus|null $applicationStatuses
 * @property-read \App\Entities\JobApplicationSeries\JobApplication\JobApplication|null $jobApplications
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicationStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicationStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicationStatus query()
 * @property int $id
 * @property int $application_status_id
 * @property int $job_application_id
 * @property string|null $reject_reason
 * @property string|null $hired_at Ngày được ứng tuyển
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicationStatus whereApplicationStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicationStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicationStatus whereHiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicationStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicationStatus whereJobApplicationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicationStatus whereRejectReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobApplicationStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class JobApplicationStatus extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobApplicationStatusRelationship;

    protected $table = 'job_application_status';

    public const FILLABLE_FIELDS = [
        'application_status_id',
        'job_application_id',
        'reject_reason',
        'hired_at',
    ];
}
