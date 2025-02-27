<?php

namespace App\Repositories\UserCourseResource;

use App\Entities\UserCourseResource\UserCourseResource;
use App\Repositories\BaseRepository;

class UserCourseResourceRepositoryEloquent extends BaseRepository implements UserCourseResourceRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserCourseResource::class;
    }
}
