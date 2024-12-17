<?php

namespace App\Repositories\UserExperienceResource;

use App\Entities\UserExperienceResource\UserExperienceResource;
use App\Repositories\BaseRepository;
use App\Repositories\UserExperience\UserExperienceRepository;

class UserExperienceResourceRepositoryEloquent extends BaseRepository implements UserExperienceRepository
{
    public function model()
    {
        return UserExperienceResource::class;
    }
}
