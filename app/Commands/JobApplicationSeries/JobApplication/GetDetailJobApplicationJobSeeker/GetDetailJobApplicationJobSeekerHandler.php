<?php

namespace App\Commands\JobApplicationSeries\JobApplication\GetDetailJobApplicationJobSeeker;

use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobApplicationSeries\JobApplication\JobApplicationResource;
use App\Repositories\JobApplicationSeries\JobApplication\JobApplicationRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailJobApplicationJobSeekerHandler
{
    public function __construct(
        protected JobApplicationRepository $jobApplicationRepository
    )
    {
    }

    public function handle(GetDetailJobApplicationJobSeekerCommand $command): array
    {
        try {
            $cache = redisCacheDB()->tags([JobApplicationEnum::TAG_NAME->value])->has(
                generateCacheName(
                    JobApplicationEnum::DETAIL_JOB_APPLICATION_JOB_SEEKER->value,
                    $command
                )
            );

            $jobApplication = redisCacheDB()->tags([JobApplicationEnum::TAG_NAME->value])
                ->remember(
                    generateCacheName(
                        JobApplicationEnum::DETAIL_JOB_APPLICATION_JOB_SEEKER->value,
                        $command
                    ),
                    CacheTTL::HARD->value,
                    fn() => $this->jobApplicationRepository->findByUserIdAndJobIdWithRelationships(
                        jobApplicationId: $command->jobApplicationId,
                        userId: $command->userId,
                        jobListingId: $command->jobListingId,
                        relationships: [
                            'users', 'jobListings', 'applicationCV', 'applicationStatuses',
                            'jobApplicationStatus.applicationStatuses'
                        ]
                    )
                );

            return [
                'data' => JobApplicationResource::collection($jobApplication),
                'message' => __('messages.job-application.job_application_get_info_success'),
                'cache' => $cache
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.job-application.job_application_get_info_error'),
                'error' => $e
            ];
        }
    }
}
