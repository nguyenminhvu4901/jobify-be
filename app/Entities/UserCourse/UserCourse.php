<?php

namespace App\Entities\UserCourse;

use App\Entities\UserCourse\Traits\UserCourseRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class UserCourse extends Model implements Transformable
{
    use TransformableTrait, HasFactory, UserCourseRelationship;

    protected $table = 'user_courses';

    protected $fillable = [
        'user_id',
        'name',
        'organization',
        'start_date',
        'end_date',
        'description'
    ];
}
