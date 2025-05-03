<?php

namespace App\Repositories\JobSeries\JobModerationStatus;

use App\Entities\JobSeries\JobModerationStatus\JobModerationStatus;
use App\Repositories\BaseRepository;

class JobModerationStatusRepositoryEloquent extends BaseRepository implements JobModerationStatusRepository
{
    public function model(): string
    {
        return JobModerationStatus::class;
    }
}
