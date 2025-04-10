<?php

namespace App\Commands\JobSeries\JobListing\GetListAllJob;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\JobSeries\JobListingEnum;
use App\Http\Resources\JobSeries\JobListings\JobListingResource;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use Illuminate\Support\Facades\Cache;

class GetListAllJobHandler
{
    public function __construct(
        protected JobListingRepository $jobListingRepository
    )
    {
    }

    public function handle(GetListAllJobCommand $command)
    {
        try {
            $cache = Cache::tags([JobListingEnum::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        JobListingEnum::LIST_ALL_JOBS->value,
                        $command
                    )
                );

            $jobListings = Cache::tags([JobListingEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    JobListingEnum::LIST_ALL_JOBS->value,
                    $command
                ),
                CacheTTL::HARD->value,
                fn() => $this->jobListingRepository->paginateWithRelationship(
                    relationship: ['companies'],
                    limit: $command->limit
                )
            );

            return [
                'data' => JobListingResource::collection($jobListings),
                'message' => __('messages.job.job_get_info_success'),
                'cache' => $cache,
                'pagination' => formatPaginationData($jobListings)
            ];

        }catch (\Exception $e){

            return [
                'message' => __('messages.job.job_get_info_error'),
                'error' => $e
            ];
        }
    }
}
