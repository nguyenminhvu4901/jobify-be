<?php

namespace App\Repositories\UserExperience;

use App\Entities\UserExperience\UserExperience;

interface UserExperienceRepository
{
    public function create(array $data);
}
