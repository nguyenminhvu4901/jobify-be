<?php

namespace App\Commands\JobSeries\JobListing\DestroyJob;

use App\Repositories\JobSeries\JobListing\JobListingRepository;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestroyJobHandler
{
    public function __construct(
        protected JobListingRepository $jobListingRepository
    ) {
    }

    public function handle(DestroyJobCommand $command): array
    {
        try {
            $checkExist = $this->jobListingRepository->checkExistsByCompanyIdAndJobListingId(
                $command->companyId,
                $command->jobListingId
            );

            if (! $checkExist) {
                return [
                    'message' => __('messages.response.resource_not_found'),
                    'status_code' => ResponseAlias::HTTP_NOT_FOUND,
                ];
            }

            $result = $this->jobListingRepository->destroyDataWithTransaction(
                $command->jobListingId
            );

            if ($result['success']) {
                return [
                    'jobListingDestroy' => $result['success'],
                    'message' => __('messages.job.job_destroy_profile_success'),
                ];
            }

            return [
                'message' => $result['message'] ?? __('messages.job.job_destroy_profile_error'),
                'error' => $result['error'] ?? null,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR,
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.job.job_destroy_profile_error'),
                'error' => $e,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR,
            ];
        }
    }
}
