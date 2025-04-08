<?php

namespace App\Commands\JobSeries\JobType\GetListJobType;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\JobSeries\JobTypeEnum;
use App\Http\Resources\JobSeries\JobTypes\JobTypeResource;
use App\Repositories\JobSeries\JobType\JobTypeRepository;
use Illuminate\Support\Facades\Cache;

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
            $cache = Cache::tags([JobTypeEnum::TAG_NAME->value])->has(
                JobTypeEnum::LIST_ALL_JOB_TYPE->value);

            $jobAgeRanges = Cache::tags([JobTypeEnum::TAG_NAME->value])
                ->remember(
                    JobTypeEnum::LIST_ALL_JOB_TYPE->value,
                    CacheTTL::HARD->value,
                    fn() => $this->jobTypeRepository->get()
                );

            return [
                'data' => JobTypeResource::collection($jobAgeRanges),
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
