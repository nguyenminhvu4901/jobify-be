<?php

namespace App\Repositories\UserSkill;

use App\Entities\UserSkill\UserSkill;
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
