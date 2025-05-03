<?php

namespace App\Repositories\ProfileSeries\UserCourse;

use App\Entities\ProfileSeries\UserCourse\UserCourse;
use App\Repositories\BaseRepository;

class UserCourseRepositoryEloquent extends BaseRepository implements UserCourseRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserCourse::class;
    }
}
