<?php

namespace App\Commands\JobSeries\JobListing\UpdateJobActiveStatus;

use App\Http\Resources\JobSeries\JobListings\JobListingResource;
use App\Repositories\JobSeries\JobListing\JobListingRepository;

class UpdateJobActiveStatusHandler
{
    public function __construct(
        protected JobListingRepository $jobListingRepository
    ) {
    }

    public function handle(UpdateJobActiveStatusCommand $command): array
    {
        try {
            $jobListing = $this->jobListingRepository->updateDataWithTransaction(
                $this->prepareJobStatusData($command),
                $command->jobListingId
            );

            if (! $jobListing['success']) {
                return [
                    'message' => __('messages.job.job_update_profile_error'),
                    'error' => $result['error'] ?? null,
                ];
            }

            return [
                'data' => JobListingResource::make($jobListing['data']),
                'message' => __('messages.profile.user_update_profile_success'),
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.job.job_update_profile_error'),
                'error' => $e,
            ];
        }
    }

    private function prepareJobStatusData(UpdateJobActiveStatusCommand $command): array
    {
        return [
            'active_status_id' => $command->activeStatusId,
        ];
    }
}
