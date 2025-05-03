<?php

namespace App\Repositories\ProfileSeries\UserActivity;

use App\Entities\ProfileSeries\UserActivity\UserActivity;
use App\Repositories\BaseRepository;

class UserActivityRepositoryEloquent extends BaseRepository implements UserActivityRepository
{
    public function model(): string
    {
        return UserActivity::class;
    }
}
