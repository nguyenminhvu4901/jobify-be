<?php

namespace App\Repositories\JobApplicationSeries\ApplicationCV;

use App\Entities\JobApplicationSeries\ApplicationCV\ApplicationCV;
use App\Repositories\BaseRepository;

class ApplicationCVRepositoryEloquent extends BaseRepository implements ApplicationCVRepository
{
    public function model(): string
    {
        return ApplicationCV::class;
    }
}
