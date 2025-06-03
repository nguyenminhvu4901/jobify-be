<?php

namespace App\Entities\JobApplicationSeries\JobApplicationStatus;

use App\Entities\JobApplicationSeries\JobApplicationStatus\Traits\JobApplicationStatusTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class JobApplicationStatus extends BaseModel implements Transformable
{
    use JobApplicationStatusTrait;

    protected $table = 'job_application_status';

    public const FILLABLE_FIELDS = [
        'application_status_id',
        'job_application_id',
        'reject_reason',
        'hired_at',
    ];
}
