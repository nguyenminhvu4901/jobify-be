<?php

namespace App\Entities\ProfileSeries\UserCourse;

use App\Entities\ProfileSeries\UserCourse\Traits\UserCourseTrait;
use App\Enums\RouteNames\Profile\UserCourseEnum;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserCourse extends BaseModel implements Transformable
{
    use UserCourseTrait;

    protected $table = UserCourseEnum::TABLE->value;

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'organization',
        'start_date',
        'end_date',
        'description'
    ];
}
