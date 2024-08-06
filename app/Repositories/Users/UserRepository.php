<?php

namespace App\Repositories\Users;

use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository
{

    public function model()
    {
        return User::class;
    }
}
