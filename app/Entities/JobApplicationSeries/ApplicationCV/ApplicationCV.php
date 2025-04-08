<?php

namespace App\Entities\JobApplicationSeries\ApplicationCV;

use App\Entities\JobApplicationSeries\ApplicationCV\Traits\ApplicationCVRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ApplicationCV extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, ApplicationCVRelationship;

    protected $table = 'application_cv';

    public const FILLABLE_FIELDS = [
        'title', 'path', 'job_application_id'
    ];
}
