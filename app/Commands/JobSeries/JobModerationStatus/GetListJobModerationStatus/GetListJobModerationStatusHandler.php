<?php

namespace App\Commands\JobSeries\JobModerationStatus\GetListJobModerationStatus;

use App\Enums\RouteNames\JobSeries\JobModerationStatusEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobSeries\JobModerationStatus\JobModerationStatusResource;
use App\Repositories\JobSeries\JobModerationStatus\JobModerationStatusRepository;

class GetListJobModerationStatusHandler
{
    public function __construct(
        protected JobModerationStatusRepository $jobModerationStatusRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $cache = redisHardCacheDB()->tags([JobModerationStatusEnum::TAG_NAME->value])->has(
                JobModerationStatusEnum::LIST_ALL_JOB_MODERATION_STATUS->value);

            $jobModerationStatuses = redisHardCacheDB()->tags([JobModerationStatusEnum::TAG_NAME->value])
                ->remember(
                    JobModerationStatusEnum::LIST_ALL_JOB_MODERATION_STATUS->value,
                    CacheTTL::HARD->value,
                    fn() => $this->jobModerationStatusRepository->get()
                );

            return [
                'data' => JobModerationStatusResource::collection($jobModerationStatuses),
                'message' => __('messages.job.job_get_info_success'),
                'cache' => $cache
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.job.job_get_info_error'),
                'error' => $e
            ];
        }
    }
}
