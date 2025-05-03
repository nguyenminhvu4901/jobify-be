<?php

namespace App\Repositories\ProfileSeries\UserLocation;

use App\Entities\ProfileSeries\UserLocation\UserLocation;
use App\Repositories\BaseRepository;

class UserLocationRepositoryEloquent extends BaseRepository implements UserLocationRepository
{
    public function model(): string
    {
        return UserLocation::class;
    }
}
