<?php

namespace App\Commands\JobSeries\JobListing\GetDetailJobByJobId;

use App\Enums\RouteNames\JobSeries\JobListingEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\JobSeries\JobListings\JobListingResource;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailJobByJobIdHandler
{
    public function __construct(
        protected JobListingRepository $jobListingRepository
    )
    {
    }

    public function handle(GetDetailJobByJobIdCommand $command)
    {
        try {
            $cache = Cache::tags([JobListingEnum::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        JobListingEnum::DETAIL_JOB_BY_JOB_ID->value,
                        $command
                    )
                );

            $jobDetail = Cache::tags([JobListingEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    JobListingEnum::DETAIL_JOB_BY_JOB_ID->value,
                    $command
                ),
                CacheTTL::HARD->value,
                fn() => $this->jobListingRepository->findWithRelationships(
                    id: $command->jobId,
                    relationship: ['companies']
                )
            );

            return [
                'data' => JobListingResource::make($jobDetail),
                'message' => __('messages.job.job_get_info_success'),
                'cache' => $cache,
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.job.job_get_info_error'),
                'error' => $e
            ];
        }
    }
}
