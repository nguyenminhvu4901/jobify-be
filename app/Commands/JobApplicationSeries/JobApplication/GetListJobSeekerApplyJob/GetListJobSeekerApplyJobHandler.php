<?php

namespace App\Commands\JobApplicationSeries\JobApplication\GetListJobSeekerApplyJob;

use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobApplicationSeries\JobApplication\JobApplicationResource;
use App\Repositories\JobApplicationSeries\JobApplication\JobApplicationRepository;

class GetListJobSeekerApplyJobHandler
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
     * @param GetListJobSeekerApplyJobCommand $command
     * @return array
     */
    public function handle(GetListJobSeekerApplyJobCommand $command): array
    {
        try {
            $cache = redisCacheDB()->tags([JobApplicationEnum::TAG_NAME->value])->has(
                generateCacheName(
                    JobApplicationEnum::LIST_JOB_SEEKER_APPLY_JOB->value,
                    $command
                )
            );

            $jobApplication = redisCacheDB()->tags([JobApplicationEnum::TAG_NAME->value])
                ->remember(
                    generateCacheName(
                        JobApplicationEnum::LIST_JOB_SEEKER_APPLY_JOB->value,
                        $command
                    ),
                    CacheTTL::HARD->value,
                    fn() => $this->jobApplicationRepository->getByJobListingIdAndJobIdWithRelationships(
                        jobListingId: $command->jobListingId,
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
