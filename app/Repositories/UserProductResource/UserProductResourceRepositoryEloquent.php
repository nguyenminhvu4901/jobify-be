<?php

namespace App\Repositories\UserProductResource;

use App\Entities\UserProductResource\UserProductResource;
use App\Repositories\BaseRepository;

class UserProductResourceRepositoryEloquent extends BaseRepository implements  UserProductResourceRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserProductResource::class;
    }
}
