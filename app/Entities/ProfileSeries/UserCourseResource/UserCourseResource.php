<?php

namespace App\Entities\ProfileSeries\UserCourseResource;

use App\Entities\ProfileSeries\UserCourseResource\Traits\UserCourseResourceRelationship;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserCourseResource extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory, UserCourseResourceRelationship;

    protected $table = 'user_course_resources';

    public const FILLABLE_FIELDS = [
        'user_course_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
