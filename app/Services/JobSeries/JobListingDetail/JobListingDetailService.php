<?php

namespace App\Services\JobSeries\JobListingDetail;

use App\DataTransferObjects\JobSeries\JobListingDetails\JobListingDetailData;
use App\Repositories\JobSeries\JobListingDetail\JobListingDetailRepository;

class JobListingDetailService
{
    public function __construct(
        protected JobListingDetailRepository $jobListingDetailRepository
    )
    {
    }

    /**
     * @param JobListingDetailData|array|null $storeJobListingDetailData
     * @param int $jobListingId
     * @return array
     */
    public function storeJobListingDetail(
        JobListingDetailData|null|array $storeJobListingDetailData,
        int                             $jobListingId
    ): array
    {
        return $this->jobListingDetailRepository->storeDataWithTransaction(
            $this->jobListingDetail($storeJobListingDetailData[0] ?? null, $jobListingId)
        );
    }

    /**
     * @param JobListingDetailData|array|null $jobListingDetailData
     * @param int $jobListingId
     * @return array|null
     */
    public function updateJobListingDetail(
        JobListingDetailData|null|array $jobListingDetailData,
        int                             $jobListingId
    ): ?array
    {
        $listingDetailData = $jobListingDetailData[0] ?? null;

        if (!$listingDetailData) {
            return null;
        }

        if (!empty($listingDetailData->jobListingDetailId)) {
            return $this->jobListingDetailRepository->updateDataWithTransaction(
                $this->jobListingDetail($listingDetailData, $jobListingId),
                $listingDetailData->jobSalaryId
            );
        }

        $jobListingDetail = $this->jobListingDetailRepository->getFirstByJobListingId($jobListingId);

        if (!empty($jobListingDetail)) {
            $this->jobListingDetailRepository->destroyDataWithTransaction(
                $jobListingDetail->id
            );

            return $this->jobListingDetailRepository->storeDataWithTransaction(
                $this->jobListingDetail($listingDetailData, $jobListingId),

            );
        }

        return null;
    }

    /**
     * @param JobListingDetailData|array|null $data
     * @param int $jobListingId
     * @return array
     */
    private function jobListingDetail(
        JobListingDetailData|null|array $data,
        int                             $jobListingId
    ): array
    {
        return [
            'job_listing_id' => $jobListingId,
            'description' => $data->description,
            'requirement' => $data->requirement,
            'income' => $data->income,
            'benefit' => $data->benefit,
            'working_hour' => $data->working_hour
        ];
    }
}
