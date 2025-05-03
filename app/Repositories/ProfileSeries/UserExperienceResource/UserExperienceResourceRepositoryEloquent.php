<?php

namespace App\Repositories\ProfileSeries\UserExperienceResource;

use App\Entities\ProfileSeries\UserExperienceResource\UserExperienceResource;
use App\Repositories\BaseRepository;

class UserExperienceResourceRepositoryEloquent extends BaseRepository implements UserExperienceResourceRepository
{
    public function model(): string
    {
        return UserExperienceResource::class;
    }
}
