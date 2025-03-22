<?php

namespace App\Repositories\ProfileSeries\UserCertification;

use App\Entities\ProfileSeries\UserCertification\UserCertification;
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
