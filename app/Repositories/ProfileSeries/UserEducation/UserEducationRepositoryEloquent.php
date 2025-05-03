<?php

namespace App\Repositories\ProfileSeries\UserEducation;

use App\Entities\ProfileSeries\UserEducation\UserEducation;
use App\Repositories\BaseRepository;

class UserEducationRepositoryEloquent extends BaseRepository implements UserEducationRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserEducation::class;
    }
}
