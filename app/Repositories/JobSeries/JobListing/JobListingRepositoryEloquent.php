<?php

namespace App\Repositories\JobSeries\JobListing;

use App\Entities\JobSeries\JobListing\JobListing;
use App\Enums\RouteNames\JobSeries\JobModerationStatusEnum;
use App\Repositories\BaseRepository;

class JobListingRepositoryEloquent extends BaseRepository implements JobListingRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return JobListing::class;
    }

    public function syncStoreJobModerationStatus(JobListing $jobListing): array
    {
        return $jobListing->jobModerationStatus()->sync([JobModerationStatusEnum::PENDING->value]);
    }

    public function getJobListingsByCompanyId($companyId, array $relationships = []): mixed
    {
        return $this->model->withRelationships($relationships)->whereByCompanyId($companyId)->get();
    }
}
