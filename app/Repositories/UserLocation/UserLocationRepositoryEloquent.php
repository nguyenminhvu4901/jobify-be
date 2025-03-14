<?php

namespace App\Repositories\UserLocation;

use App\Entities\UserLocation\UserLocation;
use App\Repositories\BaseRepository;

class UserLocationRepositoryEloquent extends BaseRepository implements UserLocationRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserLocation::class;
    }
}
