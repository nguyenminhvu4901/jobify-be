<?php

namespace App\Repositories\UserProject;

use App\Entities\UserProject\UserProject;
use App\Repositories\BaseRepository;

class UserProjectRepositoryEloquent extends BaseRepository implements UserProjectRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserProject::class;
    }
}
