<?php

namespace App\Repositories\JobSeries\JobPosition;

use App\Entities\JobSeries\JobPosition\JobPosition;
use App\Repositories\BaseRepository;

class JobPositionRepositoryEloquent extends BaseRepository implements JobPositionRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return JobPosition::class;
    }
}
