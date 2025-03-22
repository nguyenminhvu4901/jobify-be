<?php

namespace App\Repositories\ProfileSeries\UserProject;

use App\Entities\ProfileSeries\UserProject\UserProject;
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
