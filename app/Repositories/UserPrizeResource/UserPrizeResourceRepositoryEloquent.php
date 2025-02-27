<?php

namespace App\Repositories\UserPrizeResource;

use App\Entities\UserPrizeResource\UserPrizeResource;
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
