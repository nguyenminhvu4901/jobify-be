<?php

namespace App\Commands\JobSeries\JobSalaryType\GetListJobSalaryType;

use App\Enums\RouteNames\JobSeries\JobSalaryTypeEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobSeries\JobSalaryTypes\JobSalaryTypeResource;
use App\Repositories\JobSeries\JobSalaryType\JobSalaryTypeRepository;
use Illuminate\Support\Facades\Cache;

class GetListJobSalaryTypeHandler
{
    public function __construct(
        protected JobSalaryTypeRepository $jobSalaryTypeRepository
    ) {
    }

    public function handle(): array
    {
        try {
            $cache = Cache::tags([JobSalaryTypeEnum::TAG_NAME->value])->has(
                JobSalaryTypeEnum::LIST_ALL_JOB_SALARY_TYPE->value
            );

            $jobSalaryTypes = Cache::tags([JobSalaryTypeEnum::TAG_NAME->value])
                ->remember(
                    JobSalaryTypeEnum::LIST_ALL_JOB_SALARY_TYPE->value,
                    CacheTTL::HARD->value,
                    fn () => $this->jobSalaryTypeRepository->get()
                );

            return [
                'data' => JobSalaryTypeResource::collection($jobSalaryTypes),
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
