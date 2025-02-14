<?php

namespace App\Repositories\UserSkill;

use App\Entities\UserSkill\UserSkill;

interface UserSkillRepository
{
    public function create(array $attributes);

    public function updateUserSkill(array $attributes, int $userSkillId);

    public function destroy(UserSkill $userSkill);
}
