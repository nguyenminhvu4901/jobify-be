<?php

namespace App\Observers\Searchable\JobSeries\JobLocation;

use App\Entities\JobSeries\JobLocation\JobLocation;
use App\Jobs\Searchable\JobListing\DeleteRecordJobListing;
use App\Jobs\Searchable\JobListing\ReindexJobListing;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Services\Observer\ObserverFlag;

class LocationSyncJobObserver
{
    public function __construct(
        protected JobListingRepository $jobListingRepository,
        protected ObserverFlag $flag
    )
    {
    }

    /**
     * @param JobLocation $jobLocation
     * @return void
     */
    public function created(JobLocation $jobLocation): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobLocation);
    }

    /**
     * @param JobLocation $jobLocation
     * @return void
     */
    public function updated(JobLocation $jobLocation): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobLocation);
    }

    /**
     * @param JobLocation $jobLocation
     * @return void
     */
    public function saved(JobLocation $jobLocation): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobLocation);
    }

    /**
     * @param JobLocation $jobLocation
     * @return void
     */
    public function deleted(JobLocation $jobLocation): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($jobLocation);
    }

    /**
     * @param JobLocation $jobLocation
     * @return void
     */
    public function restored(JobLocation $jobLocation): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobLocation);
    }

    /**
     * @param JobLocation $jobLocation
     * @return void
     */
    public function forceDeleted(JobLocation $jobLocation): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($jobLocation);
    }

    /**
     * @param JobLocation $jobLocation
     * @return void
     */
    private function dispatchReindexJobs(JobLocation $jobLocation): void
    {
        $jobListing = $this->jobListingRepository->findById($jobLocation->job_listing_id);

        if(!empty($jobListing)){
            dispatch(new ReindexJobListing($jobListing));
        }
    }

    /**
     * @param JobLocation $jobLocation
     * @return void
     */
    private function dispatchDeleteJobs(JobLocation $jobLocation): void
    {
        $jobListing = $this->jobListingRepository->findById($jobLocation->job_listing_id);

        if(!empty($jobListing)){
            dispatch(new DeleteRecordJobListing($jobListing));
        }
    }
}
