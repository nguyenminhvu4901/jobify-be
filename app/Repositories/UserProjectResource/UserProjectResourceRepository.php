<?php

namespace App\Repositories\UserProjectResource;

use App\Entities\UserProjectResource\UserProjectResource;

interface UserProjectResourceRepository
{
    public function store(array $attributes);

    public function updateUserProjectResource(array $attributes, int|string $userProjectResourceId);

    public function destroy(UserProjectResource $userProjectResource);
}
