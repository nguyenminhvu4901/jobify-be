<?php

namespace App\Repositories\ProfileSeries\UserCertificationResource;

use App\Entities\ProfileSeries\UserCertificationResource\UserCertificationResource;
use App\Repositories\BaseRepository;

class UserCertificationResourceRepositoryEloquent extends BaseRepository implements UserCertificationResourceRepository
{
    public function model(): string
    {
        return UserCertificationResource::class;
    }
}
