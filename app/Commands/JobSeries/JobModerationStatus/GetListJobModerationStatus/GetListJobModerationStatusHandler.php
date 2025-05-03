<?php

namespace App\Commands\JobSeries\JobModerationStatus\GetListJobModerationStatus;

use App\Enums\RouteNames\JobSeries\JobModerationStatusEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobSeries\JobModerationStatus\JobModerationStatusResource;
use App\Repositories\JobSeries\JobModerationStatus\JobModerationStatusRepository;
use Illuminate\Support\Facades\Cache;

class GetListJobModerationStatusHandler
{
    public function __construct(
        protected JobModerationStatusRepository $jobModerationStatusRepository
    )
    {
    }

    public function handle()
    {
        try {
            $cache = Cache::tags([JobModerationStatusEnum::TAG_NAME->value])->has(
                JobModerationStatusEnum::LIST_ALL_JOB_MODERATION_STATUS->value);

            $jobModerationStatuses = Cache::tags([JobModerationStatusEnum::TAG_NAME->value])
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
