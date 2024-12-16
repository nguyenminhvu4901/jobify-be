<?php

namespace App\Entities\UserCourseResource;

use App\Entities\UserCourseResource\Traits\UserCourseResourceRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserCourseResource extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserCourseResourceRelationship;

    protected $table = 'user_course_resources';

    protected $fillable = [
        'user_course_id',
        'title',
        'path',
        'description',
        'content_type_id'
    ];
}
