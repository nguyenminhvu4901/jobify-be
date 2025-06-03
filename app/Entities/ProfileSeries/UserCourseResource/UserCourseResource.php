<?php

namespace App\Entities\ProfileSeries\UserCourseResource;

use App\Entities\ProfileSeries\UserCourse\Traits\UserCourseTrait;
use App\Models\BaseModel;
use Prettus\Repository\Contracts\Transformable;

class UserCourseResource extends BaseModel implements Transformable
{
    use UserCourseTrait;

    protected $table = 'user_course_resources';

    public const FILLABLE_FIELDS = [
        'user_course_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
