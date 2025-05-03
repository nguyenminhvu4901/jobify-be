<?php

namespace App\Repositories\ProfileSeries\UserProductResource;

use App\Entities\ProfileSeries\UserProductResource\UserProductResource;
use App\Repositories\BaseRepository;

class UserProductResourceRepositoryEloquent extends BaseRepository implements UserProductResourceRepository
{
    public function model(): string
    {
        return UserProductResource::class;
    }
}
