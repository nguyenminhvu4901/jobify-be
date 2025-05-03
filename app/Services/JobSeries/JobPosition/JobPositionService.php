<?php

namespace App\Services\JobSeries\JobPosition;

use App\Enums\RouteNames\JobSeries\PositionEnum;
use App\Repositories\JobSeries\JobPosition\JobPositionRepository;

class JobPositionService
{
    public function __construct(
        protected JobPositionRepository $jobPositionRepository
    ) {
    }

    public function storeJobPosition(
        int $jobPositionMainId,
        int $jobListingId,
        ?array $jobPositionSecondary
    ): array {
        return $this->jobPositionRepository->insertTransaction(
            array_merge(
                [$this->saveJobPositionMain($jobPositionMainId, $jobListingId)],
                $this->saveJobPositionSecondary($jobListingId, $jobPositionSecondary ?? null)
            )
        );
    }

    public function updateJobPosition(
        int $jobPositionMainId,
        int $jobListingId,
        ?array $jobPositionSecondary
    ): array {
        $this->destroyJobPosition($jobListingId);

        return $this->storeJobPosition(
            $jobPositionMainId,
            $jobListingId,
            $jobPositionSecondary
        );
    }

    public function destroyJobPosition(int $jobListingId): array
    {
        return $this->jobPositionRepository->massDeleteTransaction('job_listing_id', [$jobListingId]);
    }

    private function saveJobPositionMain(
        int $jobPositionMainId,
        int $jobListingId
    ): array {
        return [
            'job_listing_id' => $jobListingId,
            'position_id' => $jobPositionMainId,
            'priority' => PositionEnum::MAIN_PRIORITY->value,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function saveJobPositionSecondary(
        int $jobListingId,
        ?array $jobPositionSecondary
    ): array {
        $jobPositionSecondaryArray = [];

        if (! empty($jobPositionSecondary)) {
            foreach ($jobPositionSecondary as $data) {

                $jobPositionSecondaryArray[] = [
                    'job_listing_id' => $jobListingId,
                    'position_id' => $data,
                    'priority' => PositionEnum::SECONDARY_PRIORITY->value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        return $jobPositionSecondaryArray;
    }
}
