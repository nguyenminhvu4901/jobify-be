<?php

namespace App\Observers\Searchable\JobSeries\JobPosition;

use App\Entities\JobSeries\JobPosition\JobPosition;
use App\Jobs\Searchable\JobListing\DeleteRecordJobListing;
use App\Jobs\Searchable\JobListing\ReindexJobListing;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Services\Observer\ObserverFlag;

class PositionSyncJobObserver
{
    public function __construct(
        protected JobListingRepository $jobListingRepository,
        protected ObserverFlag $flag
    )
    {
    }

    /**
     * @param JobPosition $jobPosition
     * @return void
     */
    public function created(JobPosition $jobPosition): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobPosition);
    }

    /**
     * @param JobPosition $jobPosition
     * @return void
     */
    public function updated(JobPosition $jobPosition): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobPosition);
    }

    /**
     * @param JobPosition $jobPosition
     * @return void
     */
    public function saved(JobPosition $jobPosition): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobPosition);
    }

    /**
     * @param JobPosition $jobPosition
     * @return void
     */
    public function deleted(JobPosition $jobPosition): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($jobPosition);
    }

    /**
     * @param JobPosition $jobPosition
     * @return void
     */
    public function restored(JobPosition $jobPosition): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobPosition);
    }

    /**
     * @param JobPosition $jobPosition
     * @return void
     */
    public function forceDeleted(JobPosition $jobPosition): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($jobPosition);
    }

    /**
     * @param JobPosition $jobPosition
     * @return void
     */
    private function dispatchReindexJobs(JobPosition $jobPosition): void
    {
        $jobListing = $this->jobListingRepository->findById($jobPosition->job_listing_id);

        if(!empty($jobListing)){
            dispatch(new ReindexJobListing($jobListing));
        }
    }

    /**
     * @param JobPosition $jobPosition
     * @return void
     */
    private function dispatchDeleteJobs(JobPosition $jobPosition): void
    {
        $jobListing = $this->jobListingRepository->findById($jobPosition->job_listing_id);

        if(!empty($jobListing)){
            dispatch(new DeleteRecordJobListing($jobListing));
        }
    }
}
