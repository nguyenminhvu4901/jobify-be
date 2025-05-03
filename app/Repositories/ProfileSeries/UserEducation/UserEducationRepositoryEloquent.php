<?php

namespace App\Repositories\ProfileSeries\UserEducation;

use App\Entities\ProfileSeries\UserEducation\UserEducation;
use App\Repositories\BaseRepository;

class UserEducationRepositoryEloquent extends BaseRepository implements UserEducationRepository
{
    public function model(): string
    {
        return UserEducation::class;
    }
}
