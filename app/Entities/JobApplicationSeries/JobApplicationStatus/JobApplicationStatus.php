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
 * @mixin \Eloquent
 */
class JobApplicationStatus extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobApplicationStatusRelationship;

    protected $table = 'job_application_statuses';

    public const FILLABLE_FIELDS = [
        'application_status_id',
        'job_application_id',
        'reject_reason',
        'hired_at',
    ];
}
