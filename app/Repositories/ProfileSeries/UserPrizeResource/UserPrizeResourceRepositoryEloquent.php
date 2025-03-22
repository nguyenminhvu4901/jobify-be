<?php

namespace App\Repositories\ProfileSeries\UserPrizeResource;

use App\Entities\ProfileSeries\UserPrizeResource\UserPrizeResource;
use App\Repositories\BaseRepository;

class UserPrizeResourceRepositoryEloquent extends BaseRepository implements UserPrizeResourceRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserPrizeResource::class;
    }
}
