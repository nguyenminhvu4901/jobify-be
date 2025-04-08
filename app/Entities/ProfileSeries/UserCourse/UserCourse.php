<?php

namespace App\Entities\ProfileSeries\UserCourse;

use App\Entities\ProfileSeries\UserCourse\Traits\UserCourseRelationship;
use App\Enums\RouteNames\Profile\UserCourseEnum;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserCourse extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserCourseRelationship;

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
