<?php

namespace App\Entities\ProfileSeries\UserCourse\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserCourseTrait
{
    use TransformableTrait, HasFactory, UserCourseRelationship;
}
