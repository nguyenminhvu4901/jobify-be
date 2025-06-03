<?php

namespace App\Commands\JobApplicationSeries\JobApplication\StoreJobSeekerApplyJob;

use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use App\Http\Resources\JobApplicationSeries\JobApplication\JobApplicationResource;
use App\Repositories\JobApplicationSeries\JobApplication\JobApplicationRepository;
use App\Services\JobApplicationSeries\ApplicationCV\ApplicationCVService;
use Carbon\Carbon;

class StoreJobSeekerApplyJobHandler
{
    public function __construct(
        protected JobApplicationRepository $jobApplicationRepository,
        protected ApplicationCVService $applicationCVService
    )
    {
    }

    /**
     * @param StoreJobSeekerApplyJobCommand $command
     * @return array
     */
    public function handle(StoreJobSeekerApplyJobCommand $command): array
    {
        try {
            $saveData = $this->prepareJobApplicationData($command);

            if(empty($saveData)){
                return [
                    'message' => __('messages.job-application.job_application_max'),
                ];
            }

            $result = $this->jobApplicationRepository->storeDataWithTransaction(
                $this->prepareJobApplicationData($command)
            );

            if(empty($result['data'])){

                return [
                    'message' => __('messages.job-application.job_application_update_profile_error'),
                    'error' => $result['error'] ?? null
                ];
            }

            $this->jobApplicationRepository->syncJobApplicationStatus($result['data']->id);

            $this->applicationCVService->processSaveCV($command->applicationCV, $result['data']);

            return [
                'data' => JobApplicationResource::make($result['data']),
                'message' => __('messages.profile.job_application_update_profile_success'),
            ];

        }catch (\Exception $e){

            return [
                'message' => __('messages.job-application.job_application_update_profile_error'),
                'error' => $e
            ];
        }
    }

    /**
     * @param StoreJobSeekerApplyJobCommand $command
     * @return array
     */
    private function prepareJobApplicationData(StoreJobSeekerApplyJobCommand $command): array
    {
        $maxApplies = JobApplicationEnum::MAX_APPLIES->value;

        $appliedCount = $this->jobApplicationRepository->countJobApply(
            $command->jobListingId, $command->userId
        );

        if ($appliedCount >= $maxApplies) {
            return [];
        }

        return [
            'user_id' => $command->userId,
            'job_listing_id' => $command->jobListingId,
            'full_name' => $command->fullName,
            'email' => $command->email,
            'phone_number' => $command->phoneNumber,
            'applied_at' => Carbon::now(),
            'cover_letter' => $command->coverLetter,
            'apply_number' => ($appliedCount + 1)
        ];
    }
}
