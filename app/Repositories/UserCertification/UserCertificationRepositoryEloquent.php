<?php

namespace App\Repositories\UserCertification;

use App\Entities\UserCertification\UserCertification;
use App\Repositories\BaseRepository;

class UserCertificationRepositoryEloquent extends BaseRepository implements UserCertificationRepository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return UserCertification::class;
    }
}
