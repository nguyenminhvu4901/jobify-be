<?php

namespace App\Repositories\JobSeries\JobContact;

use App\Entities\JobSeries\JobContact\JobContact;
use App\Repositories\BaseRepository;

class JobContactRepositoryEloquent extends BaseRepository implements JobContactRepository
{
    public function model(): string
    {
        return JobContact::class;
    }

    public function getJobContactIdsByJobListingId(int $jobContactId): mixed
    {
        return $this->model->whereByJobListingId($jobContactId)->pluck('id')->values();
    }
}
