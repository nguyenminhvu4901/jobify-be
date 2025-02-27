<?php

namespace App\Repositories\UserProjectResource;

use App\Entities\UserProjectResource\UserProjectResource;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

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
