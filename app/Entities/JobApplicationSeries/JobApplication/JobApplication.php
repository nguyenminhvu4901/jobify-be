<?php

namespace App\Entities\JobApplicationSeries\JobApplication;

use App\Entities\JobApplicationSeries\JobApplication\Traits\JobApplicationRelationship;
use App\Enums\RouteNames\ApplyJob\JobApplicationEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class JobApplication extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, JobApplicationRelationship;

    protected $table = JobApplicationEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'job_listing_id',
        'applied_at',
        'cover_letter',
    ];
}
