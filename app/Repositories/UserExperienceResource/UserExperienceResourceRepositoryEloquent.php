<?php

namespace App\Repositories\UserExperienceResource;

use App\Entities\UserExperienceResource\UserExperienceResource;
use App\Repositories\BaseRepository;

class UserExperienceResourceRepositoryEloquent extends BaseRepository implements UserExperienceResourceRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserExperienceResource::class;
    }
}
