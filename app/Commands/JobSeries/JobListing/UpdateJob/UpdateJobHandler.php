<?php

namespace App\Commands\JobSeries\JobListing\UpdateJob;

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
            $jobListing = $this->jobListingService->updateJobListing($command);

            if(empty($jobListing['data'])){
                return [
                    'message' => __('messages.job.job_update_profile_error')
                ];
            }

            $this->updateJobListingRelationship($command);

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
     * @return void
     */
    private function updateJobListingRelationship(UpdateJobCommand $command): void
    {
        $this->jobSalaryService->processUpdateJobSalary(
            $command->jobSalaries, $command->jobListingId
        );

        $this->jobListingDetailService->updateJobListingDetail(
            $command->jobListingDetails ?? null, $command->jobListingId
        );

        $this->jobLocationService->processUpsertJobLocations(
            $command->jobLocations ?? null, $command->jobListingId
        );

        $this->jobPositionService->updateJobPosition(
            $command->jobPositionMainId,
            $command->jobListingId,
            $command->jobPositionSecondary
        );

        $this->jobContactService->processUpsertJobContacts(
            $command->jobContacts ?? null, $command->jobListingId
        );
    }
}
