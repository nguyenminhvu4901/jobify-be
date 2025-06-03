<?php

namespace App\Entities\JobApplicationSeries\ApplicationCV;

use App\Entities\JobApplicationSeries\ApplicationCV\Traits\ApplicationCVTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class ApplicationCV extends BaseModel implements Transformable
{
    use ApplicationCVTrait;

    protected $table = 'application_cv';

    public const FILLABLE_FIELDS = [
        'title', 'path', 'job_application_id'
    ];
}
