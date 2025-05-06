<?php

namespace App\Commands\JobSeries\JobType\GetListJobType;

use App\Enums\RouteNames\JobSeries\JobTypeEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobSeries\JobTypes\JobTypeResource;
use App\Repositories\JobSeries\JobType\JobTypeRepository;

class GetListJobTypeHandler
{
    public function __construct(
        protected JobTypeRepository $jobTypeRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $cache = redisHardCacheDB()->tags([JobTypeEnum::TAG_NAME->value])->has(
                JobTypeEnum::LIST_ALL_JOB_TYPE->value);

            $jobTypes = redisHardCacheDB()->tags([JobTypeEnum::TAG_NAME->value])
                ->remember(
                    JobTypeEnum::LIST_ALL_JOB_TYPE->value,
                    CacheTTL::HARD->value,
                    fn() => $this->jobTypeRepository->get()
                );

            return [
                'data' => JobTypeResource::collection($jobTypes),
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
