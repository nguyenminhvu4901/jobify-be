<?php

namespace App\Repositories\UserCertificationResource;

use App\Entities\UserCertificationResource\UserCertificationResource;

interface UserCertificationResourceRepository
{
    public function store(array $attributes);

    public function updateUserCertificationResource(array $attributes, string|int $userCertificationResourceId);

    public function destroy(UserCertificationResource $userCertificationResource);
}
