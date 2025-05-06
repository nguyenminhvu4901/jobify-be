<?php

namespace App\Commands\JobSeries\JobExperience\GetListJobExperience;

use App\Enums\RouteNames\JobSeries\JobExperienceEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobSeries\JobExperience\JobExperienceResource;
use App\Repositories\JobSeries\JobExperience\JobExperienceRepository;

class GetListJobExperienceHandler
{
    /**
     * @param JobExperienceRepository $jobExperienceRepository
     */
    public function __construct(
        protected JobExperienceRepository $jobExperienceRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $cache = redisHardCacheDB()->tags([JobExperienceEnum::TAG_NAME->value])->has(
                JobExperienceEnum::LIST_ALL_JOB_EXPERIENCE->value);

            $jobExperiences = redisHardCacheDB()->tags([JobExperienceEnum::TAG_NAME->value])
                ->remember(
                    JobExperienceEnum::LIST_ALL_JOB_EXPERIENCE->value,
                    CacheTTL::HARD->value,
                    fn() => $this->jobExperienceRepository->get()
                );

            return [
                'data' => JobExperienceResource::collection($jobExperiences),
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
