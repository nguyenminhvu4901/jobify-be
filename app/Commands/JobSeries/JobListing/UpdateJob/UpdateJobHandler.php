<?php

namespace App\Commands\JobSeries\JobListing\UpdateJob;

use App\Entities\JobSeries\JobListing\JobListing;
use App\Http\Resources\JobSeries\JobListings\JobListingResource;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Services\JobSeries\JobContact\JobContactService;
use App\Services\JobSeries\JobListing\JobListingService;
use App\Services\JobSeries\JobListingDetail\JobListingDetailService;
use App\Services\JobSeries\JobLocation\JobLocationService;
use App\Services\JobSeries\JobPosition\JobPositionService;
use App\Services\JobSeries\JobSalary\JobSalaryService;

class UpdateJobHandler
{
    public function __construct(
        protected JobListingRepository $jobListingRepository,
        protected JobListingService $jobListingService,
        protected JobSalaryService $jobSalaryService,
        protected JobListingDetailService $jobListingDetailService,
        protected JobLocationService $jobLocationService,
        protected JobContactService $jobContactService,
        protected JobPositionService $jobPositionService
    )
    {
    }

    public function handle(UpdateJobCommand $command): array
    {
        try {
            $jobSalary = $this->jobSalaryService->updateJobSalary(
                $command->jobSalaries, $command->jobListingId
            );

            $jobListing = $this->jobListingService->updateJobListing(
                $command, $jobSalary['data']?->id ?? null
            );

            if(empty($jobListing['data'])){
                return [
                    'message' => __('messages.job.job_update_profile_error')
                ];
            }

            $this->updateJobListingRelationship($command, $jobListing['data']);

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

    /**
     * @param UpdateJobCommand $command
     * @param JobListing $jobListing
     * @return void
     */
    private function updateJobListingRelationship(UpdateJobCommand $command, JobListing $jobListing): void
    {
        $this->jobListingDetailService->updateJobListingDetail(
            $command->jobListingDetails ?? null, $jobListing->id
        );

        $this->jobLocationService->processUpsertJobLocations(
            $command->jobLocations ?? null, $jobListing->id
        );

        $this->jobPositionService->updateJobPosition(
            $command->jobPositionMainId,
            $jobListing->id,
            $command->jobPositionSecondary
        );

        $this->jobContactService->processUpsertJobContacts(
            $command->jobContacts ?? null, $jobListing->id
        );
    }
}
