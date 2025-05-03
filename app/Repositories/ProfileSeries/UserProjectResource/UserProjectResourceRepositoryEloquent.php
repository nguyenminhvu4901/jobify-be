<?php

namespace App\Repositories\ProfileSeries\UserProjectResource;

use App\Entities\ProfileSeries\UserProjectResource\UserProjectResource;
use App\Repositories\BaseRepository;

class UserProjectResourceRepositoryEloquent extends BaseRepository implements UserProjectResourceRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserProjectResource::class;
    }
}
