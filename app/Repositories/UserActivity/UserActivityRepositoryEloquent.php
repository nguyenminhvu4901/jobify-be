<?php

namespace App\Repositories\UserActivity;

use App\Entities\UserActivity\UserActivity;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

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
