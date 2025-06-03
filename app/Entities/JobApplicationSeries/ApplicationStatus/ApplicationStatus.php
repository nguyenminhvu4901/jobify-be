<?php

namespace App\Entities\JobApplicationSeries\ApplicationStatus;

use App\Entities\JobApplicationSeries\ApplicationStatus\Traits\ApplicationStatusTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class ApplicationStatus extends BaseModel implements Transformable
{
    use ApplicationStatusTrait;

    protected $table = 'application_statuses';

    public const FILLABLE_FIELDS = [
        'name', 'description'
    ];
}
