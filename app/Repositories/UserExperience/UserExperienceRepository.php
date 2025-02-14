<?php

namespace App\Repositories\UserExperience;

use App\Entities\UserExperience\UserExperience;

interface UserExperienceRepository
{
    public function create(array $data);

    public function updateUserExperience(array $data, int|string $userExperienceId);
}
