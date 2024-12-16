<?php

namespace App\Repositories\UserProfile;

use App\Entities\UserProfile\UserProfile;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class UserProfileRepositoryEloquent extends BaseRepository implements UserProfileRepository
{
    public function model()
    {
        return UserProfile::class;
    }
}

