<?php

namespace App\Repositories\ProfileSeries\UserSkill;

use App\Entities\ProfileSeries\UserSkill\UserSkill;
use App\Repositories\BaseRepository;

class UserSkillRepositoryEloquent extends BaseRepository implements UserSkillRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserSkill::class;
    }
}
