<?php

namespace App\Repositories\ProfileSeries\UserCourseResource;

use App\Entities\ProfileSeries\UserCourseResource\UserCourseResource;
use App\Repositories\BaseRepository;

class UserCourseResourceRepositoryEloquent extends BaseRepository implements UserCourseResourceRepository
{
    public function model(): string
    {
        return UserCourseResource::class;
    }
}
