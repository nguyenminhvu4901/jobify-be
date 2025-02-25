<?php

namespace App\Repositories\UserActivityResource;

use App\Entities\UserActivityResource\UserActivityResource;

interface UserActivityResourceRepository
{
    public function store(array $attributes);

    public function updateUserActivityResource(array $attributes, string|int $userActivityResourceId);

    public function destroy(UserActivityResource $userActivityResource);
}
