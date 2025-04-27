<?php

namespace App\Commands\JobApplicationSeries\ApplicationStatus\GetListApplicationStatus;

use App\Enums\RouteNames\ApplyJob\ApplicationStatusEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobApplicationSeries\ApplicationStatus\ApplicationStatusResource;
use App\Repositories\JobApplicationSeries\ApplicationStatus\ApplicationStatusRepository;
use Illuminate\Support\Facades\Cache;

class GetListApplicationStatusHandler
{
    /**
     * @param ApplicationStatusRepository $applicationStatusRepository
     */
    public function __construct(
        protected ApplicationStatusRepository $applicationStatusRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $cache = Cache::tags([ApplicationStatusEnum::TAG_NAME->value])->has(
                ApplicationStatusEnum::LIST_APPLICATION_STATUS->value);

            $jobExperiences = Cache::tags([ApplicationStatusEnum::TAG_NAME->value])
                ->remember(
                    ApplicationStatusEnum::LIST_APPLICATION_STATUS->value,
                    CacheTTL::HARD->value,
                    fn() => $this->applicationStatusRepository->get()
                );

            return [
                'data' => ApplicationStatusResource::collection($jobExperiences),
                'message' => __('messages.job-application.job_application_get_info_success'),
                'cache' => $cache
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.job-application.job_application_get_info_error'),
                'error' => $e
            ];
        }
    }
}
