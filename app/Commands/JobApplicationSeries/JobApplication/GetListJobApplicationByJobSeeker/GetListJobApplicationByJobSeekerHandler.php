<?php

namespace App\Commands\JobApplicationSeries\JobApplication\GetListJobApplicationByJobSeeker;

use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobApplicationSeries\JobApplication\JobApplicationResource;
use App\Repositories\JobApplicationSeries\JobApplication\JobApplicationRepository;

class GetListJobApplicationByJobSeekerHandler
{
    /**
     * @param JobApplicationRepository $jobApplicationRepository
     */
    public function __construct(
        protected JobApplicationRepository $jobApplicationRepository
    )
    {
    }

    /**
     * @param GetListJobApplicationByJobSeekerCommand $command
     * @return array
     */
    public function handle(GetListJobApplicationByJobSeekerCommand $command): array
    {
        try {
            $cache = redisCacheDB()->tags([JobApplicationEnum::TAG_NAME->value])->has(
                generateCacheName(
                    JobApplicationEnum::LIST_JOB_APPLICATION_JOB_SEEKER->value,
                    $command
                )
            );

            $jobApplication = redisCacheDB()->tags([JobApplicationEnum::TAG_NAME->value])
                ->remember(
                    generateCacheName(
                        JobApplicationEnum::LIST_JOB_APPLICATION_JOB_SEEKER->value,
                        $command
                    ),
                    CacheTTL::HARD->value,
                    fn() => $this->jobApplicationRepository->getByUserIdAndJobIdWithRelationships(
                        userId: $command->userId,
                        relationships: [
                            'users', 'jobListings', 'applicationCV', 'applicationStatuses',
                            'jobApplicationStatus.applicationStatuses'
                        ],
                        limit: $command->limit
                    )
                );

            return [
                'data' => JobApplicationResource::collection($jobApplication),
                'message' => __('messages.job-application.job_application_get_info_success'),
                'cache' => $cache,
                'pagination' => formatPaginationData($jobApplication)
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.job-application.job_application_get_info_error'),
                'error' => $e
            ];
        }
    }
}
