<?php

namespace App\Repositories\JobSeries\JobContact;

use App\Entities\JobSeries\JobContact\JobContact;
use App\Repositories\BaseRepository;

class JobContactRepositoryEloquent extends BaseRepository implements JobContactRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
       return JobContact::class;
    }

    /**
     * @param int $jobContactId
     * @return mixed
     */
    public function getJobContactIdsByJobListingId(int $jobContactId): mixed
    {
        return $this->model->whereByJobListingId($jobContactId)->pluck('id')->values();
    }
}
