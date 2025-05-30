<?php

namespace App\Commands\JobSeries\JobAgeRange\GetListJobAgeRange;

use App\Enums\RouteNames\JobSeries\JobAgeRangeEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobSeries\JobAgeRanges\JobAgeRangeResource;
use App\Repositories\JobSeries\JobAgeRange\JobAgeRangeRepository;

class GetListJobAgeRangeHandler
{
    /**
     * @param JobAgeRangeRepository $jobAgeRangeRepository
     */
    public function __construct(
        protected JobAgeRangeRepository $jobAgeRangeRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $cache = redisHardCacheDB()->tags([JobAgeRangeEnum::TAG_NAME->value])->has(
                JobAgeRangeEnum::LIST_ALL_JOB_AGE_RANGE->value);

            $jobAgeRanges = redisHardCacheDB()->tags([JobAgeRangeEnum::TAG_NAME->value])
                ->remember(
                    JobAgeRangeEnum::LIST_ALL_JOB_AGE_RANGE->value,
                    CacheTTL::HARD->value,
                    fn() => $this->jobAgeRangeRepository->get()
                );

            return [
                'data' => JobAgeRangeResource::collection($jobAgeRanges),
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
