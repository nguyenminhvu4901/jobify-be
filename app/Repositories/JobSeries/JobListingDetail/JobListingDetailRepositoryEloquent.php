<?php

namespace App\Repositories\JobSeries\JobListingDetail;

use App\Entities\JobSeries\JobListingDetail\JobListingDetail;
use App\Repositories\BaseRepository;

class JobListingDetailRepositoryEloquent extends BaseRepository implements JobListingDetailRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return JobListingDetail::class;
    }

    /**
     * @param int $jobListingId
     * @return mixed
     */
    public function getFirstByJobListingId(int $jobListingId): mixed
    {
        return $this->model->whereByJobListingId($jobListingId)->first();
    }
}
