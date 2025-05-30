<?php

namespace App\Commands\JobApplicationSeries\JobApplication\GetJobApplyCount;

use App\Http\Resources\JobApplicationSeries\JobApplication\JobApplyCountResource;
use App\Repositories\JobApplicationSeries\JobApplication\JobApplicationRepository;

class GetJobApplyCountHandler
{
    public function __construct(
        protected JobApplicationRepository $jobApplicationRepository
    )
    {
    }

    public function handle(GetJobApplyCountCommand $command): array
    {
        $count = $this->jobApplicationRepository->countJobApply(
            $command->jobListingId, $command->userId
        );

        return [
            'data' => JobApplyCountResource::make($count),
            'message' => __('messages.job-application.job_application_get_info_success'),
        ];
    }
}
