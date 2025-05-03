<?php

namespace App\Repositories\ProfileSeries\UserPrize;

use App\Entities\ProfileSeries\UserPrize\UserPrize;
use App\Repositories\BaseRepository;

class UserPrizeRepositoryEloquent extends BaseRepository implements UserPrizeRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserPrize::class;
    }
}
