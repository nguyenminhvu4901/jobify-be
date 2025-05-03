<?php

namespace App\Repositories\JobApplicationSeries\ApplicationStatus;

use App\Entities\JobApplicationSeries\ApplicationStatus\ApplicationStatus;
use App\Repositories\BaseRepository;

class ApplicationStatusRepositoryEloquent extends BaseRepository implements ApplicationStatusRepository
{
    public function model(): string
    {
        return ApplicationStatus::class;
    }
}
