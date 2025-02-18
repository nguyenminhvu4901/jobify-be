<?php

namespace App\Repositories\UserExperience;

use App\Entities\UserExperience\UserExperience;

interface UserExperienceRepository
{
    public function create(array $attributes);

    public function updateUserExperience(array $data, int|string $userExperienceId);

    public function destroy(UserExperience $userExperience);
}
