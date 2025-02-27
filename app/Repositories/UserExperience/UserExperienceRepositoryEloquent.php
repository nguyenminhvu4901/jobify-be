<?php

namespace App\Repositories\UserExperience;

use App\Entities\UserExperience\UserExperience;
use App\Repositories\BaseRepository;

class UserExperienceRepositoryEloquent extends BaseRepository implements UserExperienceRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserExperience::class;
    }
}
