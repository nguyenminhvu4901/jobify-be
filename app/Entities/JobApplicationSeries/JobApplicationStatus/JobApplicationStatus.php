<?php

namespace App\Entities\JobApplicationSeries\JobApplicationStatus;

use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobApplicationStatus extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    use TransformableTrait, HasFactory;

    protected $table = 'job_application_statuses';

    public const FILLABLE_FIELDS = [
        'application_status_id',
        'job_application_id',
        'reject_reason',
        'hired_at',
    ];
}
