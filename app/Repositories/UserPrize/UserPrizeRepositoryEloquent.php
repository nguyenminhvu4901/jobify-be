<?php

namespace App\Repositories\UserPrize;

use App\Entities\UserPrize\UserPrize;
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
