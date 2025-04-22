<?php

namespace App\Commands\JobSeries\JobListing\StoreJob;

use App\Entities\JobSeries\JobListing\JobListing;
use App\Http\Resources\JobSeries\JobListings\JobListingResource;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Repositories\JobSeries\JobLocation\JobLocationRepository;
use App\Repositories\JobSeries\JobPosition\JobPositionRepository;
use App\Services\JobSeries\JobListing\StoreJobDataTransformer;

class StoreJobHandler
{
    public function __construct(
        protected JobListingRepository $jobListingRepository,
        protected StoreJobDataTransformer $storeJobDataTransformer,
        protected JobLocationRepository $jobLocationRepository,
        protected JobPositionRepository $jobPositionRepository,

    )
    {
    }

    public function handle(StoreJobCommand $command): array
    {
        try {
            $jobSalary = $this->storeJobDataTransformer->storeJobSalary($command->jobSalaries);

            $jobListing = $this->storeJobDataTransformer->saveJobListing(
                $command, $jobSalary['data']->id ?? null
            );

            if(empty($jobListing['data'])){
                return [
                    'message' => __('messages.job.job_update_profile_error')
                ];
            }

            $this->storeJobListingRelationship($command, $jobListing['data']);

            $jobListing['data']->load([
                'companies', 'gender', 'status', 'jobVisibilityStatus', 'jobModerationStatus',
                'jobListingDetail',  'jobSalaries' => fn ($query) => $query->with(['currency', 'jobSalaryType']),
                'positions', 'jobContact', 'jobLocation' => fn ($query) => $query->with(['province', 'district', 'ward']),
                'jobAgeRanges', 'jobTypes', 'jobLevels', 'jobExperiences', 'jobEducationLevels'
            ]);

            return [
                'data' => JobListingResource::make($jobListing['data']),
                'message' => __('messages.profile.user_update_profile_success'),
            ];

        }catch (\Exception $e){

            return [
                'message' => __('messages.job.job_update_profile_error'),
                'error' => $e
            ];
        }
    }

    private function storeJobListingRelationship(StoreJobCommand $command, JobListing $jobListing): void
    {
        $this->storeJobDataTransformer->saveJobListingDetail(
            $command->jobListingDetails ?? null, $jobListing->id
        );

        $this->storeJobDataTransformer->saveJobLocations(
            $command->jobLocations ?? null, $jobListing->id
        );

        $this->storeJobDataTransformer->saveJobPosition(
            $command->jobPositionMainId,
            $jobListing->id,
            $command->jobPositionSecondary
        );

        $this->jobListingRepository->syncStoreJobModerationStatus($jobListing);

        $this->storeJobDataTransformer->saveJobContacts(
            $command->jobContacts ?? null, $jobListing->id
        );
    }
}
