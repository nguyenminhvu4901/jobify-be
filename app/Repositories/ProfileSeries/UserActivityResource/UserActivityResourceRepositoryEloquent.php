<?php

namespace App\Repositories\ProfileSeries\UserActivityResource;

use App\Entities\ProfileSeries\UserActivityResource\UserActivityResource;
use App\Repositories\BaseRepository;

class UserActivityResourceRepositoryEloquent extends BaseRepository implements UserActivityResourceRepository
{
    public function model(): string
    {
        return UserActivityResource::class;
    }
}
