<?php

namespace App\Entities\JobApplicationSeries\JobApplication;

use App\Entities\JobApplicationSeries\JobApplication\Traits\JobApplicationTrait;
use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class JobApplication extends BaseModel implements Transformable
{
    use JobApplicationTrait;

    protected $table = JobApplicationEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'job_listing_id',

        'full_name',
        'email',
        'phone_number',

        'applied_at',
        'cover_letter',

        'apply_number'
    ];
}
