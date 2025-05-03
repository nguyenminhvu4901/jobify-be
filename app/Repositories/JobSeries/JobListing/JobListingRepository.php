<?php

namespace App\Repositories\JobSeries\JobListing;

use App\Entities\JobSeries\JobListing\JobListing;

interface JobListingRepository
{
    /**
     * @param array $attributes
     * @return array
     */
    public function storeDataWithTransaction(array $attributes = []): array;

    /**
     * @param JobListing $jobListing
     * @return mixed
     */
    public function syncStoreJobModerationStatus(
        JobListing $jobListing
    ): mixed;

    /**
     * @param int $companyId
     * @param array $relationships
     * @return mixed
     */
    public function getJobListingsByCompanyId(int $companyId, array $relationships = []): mixed;

    public function checkExistsByCompanyIdAndJobListingId(int $companyId, int $jobListingId);
}
