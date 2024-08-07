<?php

namespace App\Repositories\Users;

use App\Models\Users\User;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    public function searchByUsername($userName)
    {
        return $this->model->where('username', $userName)->first();
    }
}
