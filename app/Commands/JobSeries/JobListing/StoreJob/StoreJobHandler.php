<?php

namespace App\Commands\JobSeries\JobListing\StoreJob;

use App\Entities\JobSeries\JobListing\JobListing;
use App\Http\Resources\JobSeries\JobListings\JobListingResource;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Services\JobSeries\JobContact\JobContactService;
use App\Services\JobSeries\JobListing\JobListingService;
use App\Services\JobSeries\JobListingDetail\JobListingDetailService;
use App\Services\JobSeries\JobLocation\JobLocationService;
use App\Services\JobSeries\JobPosition\JobPositionService;
use App\Services\JobSeries\JobSalary\JobSalaryService;

class StoreJobHandler
{
    public function __construct(
        protected JobListingRepository $jobListingRepository,
        protected JobListingService $jobListingService,
        protected JobSalaryService $jobSalaryService,
        protected JobListingDetailService $jobListingDetailService,
        protected JobLocationService $jobLocationService,
        protected JobContactService $jobContactService,
        protected JobPositionService $jobPositionService
    ) {
    }

    public function handle(StoreJobCommand $command): array
    {
        try {
            $jobListing = $this->jobListingService->storeJobListing($command);

            if (empty($jobListing['data'])) {

                return [
                    'message' => __('messages.job.job_update_profile_error'),
                ];
            }

            $this->storeJobListingRelationship($command, $jobListing['data']);

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

    private function storeJobListingRelationship(StoreJobCommand $command, JobListing $jobListing): void
    {
        $this->jobSalaryService->massStoreJobSalary($command->jobSalaries, $jobListing->id);

        $this->jobListingDetailService->storeJobListingDetail(
            $command->jobListingDetails ?? null,
            $jobListing->id
        );

        $this->jobLocationService->storeJobLocations(
            $command->jobLocations ?? null,
            $jobListing->id
        );

        $this->jobPositionService->storeJobPosition(
            $command->jobPositionMainId,
            $jobListing->id,
            $command->jobPositionSecondary
        );

        $this->jobListingRepository->syncStoreJobModerationStatus($jobListing);

        $this->jobContactService->storeJobContacts(
            $command->jobContacts ?? null,
            $jobListing->id
        );
    }
}
