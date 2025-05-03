<?php

namespace App\Commands\JobSeries\JobVisibilityStatus\GetListJobVisibilityStatus;

use App\Enums\RouteNames\JobSeries\JobVisibilityStatusEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobSeries\JobVisibilityStatus\JobVisibilityStatusResource;
use App\Repositories\JobSeries\JobVisibilityStatus\JobVisibilityStatusRepository;
use Illuminate\Support\Facades\Cache;

class GetListJobVisibilityStatusHandler
{
    public function __construct(
        protected JobVisibilityStatusRepository $jobVisibilityStatusRepository
    ) {
    }

    public function handle(): array
    {
        try {
            $cache = Cache::tags([JobVisibilityStatusEnum::TAG_NAME->value])->has(
                JobVisibilityStatusEnum::LIST_ALL_JOB_VISIBILITY_STATUS->value
            );

            $jobVisibilityStatuses = Cache::tags([JobVisibilityStatusEnum::TAG_NAME->value])
                ->remember(
                    JobVisibilityStatusEnum::LIST_ALL_JOB_VISIBILITY_STATUS->value,
                    CacheTTL::HARD->value,
                    fn () => $this->jobVisibilityStatusRepository->get()
                );

            return [
                'data' => JobVisibilityStatusResource::collection($jobVisibilityStatuses),
                'message' => __('messages.job.job_get_info_success'),
                'cache' => $cache,
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.job.job_get_info_error'),
                'error' => $e,
            ];
        }
    }
}
