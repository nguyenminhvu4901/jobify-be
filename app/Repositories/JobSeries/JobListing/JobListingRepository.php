<?php

namespace App\Repositories\JobSeries\JobListing;

use App\Entities\JobSeries\JobListing\JobListing;

interface JobListingRepository
{
    public function storeDataWithTransaction(array $attributes = []): array;

    public function syncStoreJobModerationStatus(
        JobListing $jobListing
    ): mixed;

    public function getJobListingsByCompanyId(int $companyId, array $relationships = []): mixed;

    public function checkExistsByCompanyIdAndJobListingId(int $companyId, int $jobListingId);
}
