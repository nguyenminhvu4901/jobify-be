<?php

namespace App\Commands\JobSeries\JobListing\StoreJob;

use App\Repositories\JobSeries\JobContact\JobContactRepository;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Repositories\JobSeries\JobListingDetail\JobListingDetailRepository;
use App\Repositories\JobSeries\JobLocation\JobLocationRepository;
use App\Repositories\JobSeries\JobPosition\JobPositionRepository;
use App\Repositories\JobSeries\JobSalary\JobSalaryRepository;
use App\Services\JobSeries\JobListing\StoreJobDataTransformer;

class StoreJobHandler
{
    public function __construct(
        protected JobListingRepository $jobListingRepository,
        protected StoreJobDataTransformer $storeJobDataTransformer,
        protected JobSalaryRepository $jobSalaryRepository,
        protected JobLocationRepository $jobLocationRepository,
        protected JobPositionRepository $jobPositionRepository,
        protected JobContactRepository $jobContactRepository,
        protected JobListingDetailRepository $jobListingDetailRepository
    )
    {
    }

    public function handle(StoreJobCommand $command)
    {
        try {

        }catch (\Exception $e){

            return [
                'message' => __('messages.job.job_update_profile_error'),
                'error' => $e
            ];
        }
    }
}
