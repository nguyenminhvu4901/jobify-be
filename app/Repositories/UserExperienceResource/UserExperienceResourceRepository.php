<?php

namespace App\Repositories\UserExperienceResource;

use App\Entities\UserExperienceResource\UserExperienceResource;

interface UserExperienceResourceRepository
{
    public function store(
        array $attachment,
        int|string $userExperienceId,
        string $pathStorage
    );

    public function updateUserExperienceResource(
        array $attachment,
        int|string $userExperienceResourceId,
        string $pathStorage
    );

    public function destroy(UserExperienceResource $userExperienceResource);

    public function getListUserExperienceResourceByIds(array $userExperienceResourceId);
}
