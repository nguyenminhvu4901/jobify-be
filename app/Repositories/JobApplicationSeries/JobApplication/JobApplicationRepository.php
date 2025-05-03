<?php

namespace App\Repositories\JobApplicationSeries\JobApplication;

interface JobApplicationRepository
{
    public function findByUserIdAndJobIdWithRelationships(
        int $jobApplicationId,
        int $userId,
        int $jobListingId,
        string|array $relationships
    ): mixed;

    public function getByUserIdAndJobIdWithRelationships(
        int $userId,
        array|string $relationships,
        $limit = null,
    ): mixed;

    public function getByJobListingIdAndJobIdWithRelationships(
        int $jobListingId,
        array|string $relationships,
        $limit = null,
    ): mixed;

    public function syncJobApplicationStatus(int $jobApplicationId, ?int $applicationStatusId = null);
}
