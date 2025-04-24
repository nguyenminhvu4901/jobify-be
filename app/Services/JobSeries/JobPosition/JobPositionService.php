<?php

namespace App\Services\JobSeries\JobPosition;

use App\Enums\RouteNames\JobSeries\PositionEnum;
use App\Repositories\JobSeries\JobPosition\JobPositionRepository;

class JobPositionService
{
    public function __construct(
        protected JobPositionRepository $jobPositionRepository
    )
    {
    }

    /**
     * @param int $jobPositionMainId
     * @param int $jobListingId
     * @param array|null $jobPositionSecondary
     * @return array
     */
    public function storeJobPosition(
        int $jobPositionMainId,
        int $jobListingId,
        array|null $jobPositionSecondary
    ): array
    {
        return $this->jobPositionRepository->insertTransaction(
            array_merge(
                [$this->saveJobPositionMain($jobPositionMainId, $jobListingId)],
                $this->saveJobPositionSecondary($jobListingId, $jobPositionSecondary ?? null)
            )
        );
    }

    /**
     * @param int $jobPositionMainId
     * @param int $jobListingId
     * @param array|null $jobPositionSecondary
     * @return array
     */
    public function updateJobPosition(
        int $jobPositionMainId,
        int $jobListingId,
        array|null $jobPositionSecondary
    ): array
    {
        $this->destroyJobPosition($jobListingId);

        return $this->storeJobPosition(
            $jobPositionMainId, $jobListingId, $jobPositionSecondary
        );
    }

    /**
     * @param int $jobListingId
     * @return array
     */
    public function destroyJobPosition(int $jobListingId): array
    {
        return $this->jobPositionRepository->massDeleteTransaction('job_listing_id', [$jobListingId]);
    }

    /**
     * @param int $jobPositionMainId
     * @param int $jobListingId
     * @return array
     */
    private function saveJobPositionMain(
        int $jobPositionMainId,
        int $jobListingId
    ): array
    {
        return [
            'job_listing_id' => $jobListingId,
            'position_id' => $jobPositionMainId,
            'priority' => PositionEnum::MAIN_PRIORITY->value,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }

    /**
     * @param int $jobListingId
     * @param array|null $jobPositionSecondary
     * @return array
     */
    private function saveJobPositionSecondary(
        int $jobListingId,
        array|null $jobPositionSecondary
    ): array
    {
        $jobPositionSecondaryArray = [];

        if(!empty($jobPositionSecondary)){
            foreach ($jobPositionSecondary as $data){

                $jobPositionSecondaryArray[] = [
                    'job_listing_id' => $jobListingId,
                    'position_id' => $data,
                    'priority' => PositionEnum::SECONDARY_PRIORITY->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        return $jobPositionSecondaryArray;
    }
}
