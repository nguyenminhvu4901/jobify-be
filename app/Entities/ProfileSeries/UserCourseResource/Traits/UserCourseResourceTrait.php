<?php

namespace App\Entities\ProfileSeries\UserCourseResource\Traits;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Traits\TransformableTrait;

trait UserCourseResourceTrait
{
    use TransformableTrait, HasFactory, UserCourseResourceRelationship;
}
