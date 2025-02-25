<?php

namespace App\Repositories\UserActivity;

use App\Entities\UserActivity\UserActivity;

interface UserActivityRepository
{
    public function store(array $attributes);

    public function updateUserActivity(array $attributes, int $userActivityId);

    public function destroy(UserActivity $userActivity);
}
