<?php

namespace App\Repositories\UserActivityResource;

use App\Entities\UserActivityResource\UserActivityResource;
use App\Repositories\BaseRepository;

class UserActivityResourceRepositoryEloquent extends BaseRepository implements UserActivityResourceRepository
{

    public function model(): string
    {
        return UserActivityResource::class;
    }

    public function store(array $attributes)
    {
        // TODO: Implement store() method.
    }

    public function updateUserActivityResource(array $attributes, int|string $userActivityResourceId)
    {
        // TODO: Implement updateUserActivityResource() method.
    }

    public function destroy(UserActivityResource $userActivityResource)
    {
        // TODO: Implement destroy() method.
    }
}
