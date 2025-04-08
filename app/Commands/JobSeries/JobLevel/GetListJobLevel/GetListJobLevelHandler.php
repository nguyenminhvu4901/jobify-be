<?php

namespace App\Commands\JobSeries\JobLevel\GetListJobLevel;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\JobSeries\JobLevelEnum;
use App\Http\Resources\JobSeries\JobLevel\JobLevelResource;
use App\Repositories\JobSeries\JobLevel\JobLevelRepository;
use Illuminate\Support\Facades\Cache;

class GetListJobLevelHandler
{
    public function __construct(
        protected JobLevelRepository $jobLevelRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $cache = Cache::tags([JobLevelEnum::TAG_NAME->value])->has(
                JobLevelEnum::LIST_ALL_JOB_LEVEL->value);

            $jobLevels = Cache::tags([JobLevelEnum::TAG_NAME->value])
                ->remember(
                    JobLevelEnum::LIST_ALL_JOB_LEVEL->value,
                    CacheTTL::HARD->value,
                    fn() => $this->jobLevelRepository->get()
                );

            return [
                'data' => JobLevelResource::collection($jobLevels),
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
