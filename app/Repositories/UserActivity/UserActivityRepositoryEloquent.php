<?php

namespace App\Repositories\UserActivity;

use App\Entities\UserActivity\UserActivity;
use App\Repositories\BaseRepository;

class UserActivityRepositoryEloquent extends BaseRepository implements UserActivityRepository
{

    public function model(): string
    {
        return UserActivity::class;
    }

    public function store(array $attributes)
    {
        // TODO: Implement store() method.
    }

    public function updateUserActivity(array $attributes, int $userActivityId)
    {
        // TODO: Implement updateUserActivity() method.
    }

    public function destroy(UserActivity $userActivity)
    {
        // TODO: Implement destroy() method.
    }
}
