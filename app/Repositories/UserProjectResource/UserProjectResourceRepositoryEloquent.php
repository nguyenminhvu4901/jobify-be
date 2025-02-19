<?php

namespace App\Repositories\UserProjectResource;

use App\Entities\UserProjectResource\UserProjectResource;
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
