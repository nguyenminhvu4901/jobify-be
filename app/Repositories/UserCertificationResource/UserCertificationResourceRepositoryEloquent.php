<?php

namespace App\Repositories\UserCertificationResource;

use App\Entities\UserCertificationResource\UserCertificationResource;
use App\Repositories\BaseRepository;

class UserCertificationResourceRepositoryEloquent extends BaseRepository implements UserCertificationResourceRepository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return UserCertificationResource::class;
    }

}
