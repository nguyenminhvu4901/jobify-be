<?php

namespace App\Commands\JobSeries\JobListing\SearchJob;

use App\Http\Resources\JobSeries\JobListings\JobListingResource;
use App\Repositories\JobSeries\JobListing\JobListingRepository;

class SearchJobHandler
{
    public function __construct(
        protected JobListingRepository $jobListingRepository
    )
    {
    }

    public function handle(SearchJobCommand $command): array
    {
        try {
            $jobSearch = $this->jobListingRepository->searchAndFilterJob(
                $this->prepareData($command)
            );

            return [
                'data' => JobListingResource::collection($jobSearch),
                'message' => __('messages.job.job_get_info_success'),
                'pagination' => formatPaginationData($jobSearch)
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.job.job_get_info_error'),
                'error' => $e
            ];
        }
    }

    public function prepareData(SearchJobCommand $command): array
    {
        return [
            'search' => $command->search
        ];
    }
}
