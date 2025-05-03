<?php

namespace App\Repositories\ProfileSeries\UserExperience;

use App\Entities\ProfileSeries\UserExperience\UserExperience;
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
