<?php

namespace App\Repositories\UserEducation;

use App\Entities\UserEducation\UserEducation;
use App\Repositories\BaseRepository;

class UserEducationRepositoryEloquent extends BaseRepository implements UserEducationRepository
{

    /**
     * @return string|null
     */
    public function model(): ?string
    {
        return UserEducation::class;
    }
}
