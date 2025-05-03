<?php

namespace App\Commands\JobSeries\JobEducationLevel\GetListJobEducationLevel;

use App\Enums\RouteNames\JobSeries\JobEducationLevelEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobSeries\JobEducationLevel\JobEducationLevelResource;
use App\Repositories\JobSeries\JobEducationLevel\JobEducationLevelRepository;
use Illuminate\Support\Facades\Cache;

class GetListJobEducationLevelHandler
{
    public function __construct(
        protected JobEducationLevelRepository $jobEducationLevelRepository
    ) {
    }

    public function handle(): array
    {
        try {
            $cache = Cache::tags([JobEducationLevelEnum::TAG_NAME->value])->has(
                JobEducationLevelEnum::LIST_ALL_JOB_EDUCATION_LEVEL->value
            );

            $jobEducationLevels = Cache::tags([JobEducationLevelEnum::TAG_NAME->value])
                ->remember(
                    JobEducationLevelEnum::LIST_ALL_JOB_EDUCATION_LEVEL->value,
                    CacheTTL::HARD->value,
                    fn () => $this->jobEducationLevelRepository->get()
                );

            return [
                'data' => JobEducationLevelResource::collection($jobEducationLevels),
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
