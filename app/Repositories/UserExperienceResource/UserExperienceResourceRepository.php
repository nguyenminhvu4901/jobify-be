<?php

namespace App\Repositories\UserExperienceResource;

use App\Entities\UserExperienceResource\UserExperienceResource;

interface UserExperienceResourceRepository
{
    public function store(array $attributes);

    public function updateUserExperienceResource(
        array $attributes,
        int|string $userExperienceResourceId
    );

    public function destroy(UserExperienceResource $userExperienceResource);

    public function getListUserExperienceResourceByIds(array $userExperienceResourceId);
}
