<?php

namespace App\Repositories\UserCourse;

use App\Entities\UserCourse\UserCourse;
use App\Repositories\BaseRepository;

class UserCourseRepositoryEloquent extends BaseRepository implements UserCourseRepository
{
    public function model(): string
    {
        return UserCourse::class;
    }
}
