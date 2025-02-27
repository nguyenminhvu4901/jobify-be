<?php

namespace App\Repositories\UserActivity;

use App\Entities\UserActivity\UserActivity;
use App\Repositories\BaseRepository;

class UserActivityRepositoryEloquent extends BaseRepository implements UserActivityRepository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return UserActivity::class;
    }
}
