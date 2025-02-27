<?php

namespace App\Repositories\UserActivityResource;

use App\Entities\UserActivityResource\UserActivityResource;
use App\Repositories\BaseRepository;

class UserActivityResourceRepositoryEloquent extends BaseRepository implements UserActivityResourceRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserActivityResource::class;
    }
}
