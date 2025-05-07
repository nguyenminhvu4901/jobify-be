<?php

namespace App\Observers\Searchable\JobSeries\JobListingDetail;

use App\Entities\JobSeries\JobListingDetail\JobListingDetail;
use App\Jobs\Searchable\JobListing\DeleteRecordJobListing;
use App\Jobs\Searchable\JobListing\ReindexJobListing;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Services\Observer\ObserverFlag;

class JobDetailSyncJobObserver
{
    public function __construct(
        protected JobListingRepository $jobListingRepository,
        protected ObserverFlag $flag
    )
    {
    }

    /**
     * @param JobListingDetail $jobListingDetail
     * @return void
     */
    public function created(JobListingDetail $jobListingDetail): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobListingDetail);
    }

    /**
     * @param JobListingDetail $jobListingDetail
     * @return void
     */
    public function updated(JobListingDetail $jobListingDetail): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobListingDetail);
    }

    /**
     * @param JobListingDetail $jobListingDetail
     * @return void
     */
    public function saved(JobListingDetail $jobListingDetail): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobListingDetail);
    }

    /**
     * @param JobListingDetail $jobListingDetail
     * @return void
     */
    public function deleted(JobListingDetail $jobListingDetail): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($jobListingDetail);
    }

    /**
     * @param JobListingDetail $jobListingDetail
     * @return void
     */
    public function restored(JobListingDetail $jobListingDetail): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobListingDetail);
    }

    /**
     * @param JobListingDetail $jobListingDetail
     * @return void
     */
    public function forceDeleted(JobListingDetail $jobListingDetail): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($jobListingDetail);
    }

    /**
     * @param JobListingDetail $jobListingDetail
     * @return void
     */
    private function dispatchReindexJobs(JobListingDetail $jobListingDetail): void
    {
        $jobListing = $this->jobListingRepository->findById($jobListingDetail->job_listing_id);

        if(!empty($jobListing)){
            dispatch(new ReindexJobListing($jobListing));
        }
    }

    /**
     * @param JobListingDetail $jobListingDetail
     * @return void
     */
    private function dispatchDeleteJobs(JobListingDetail $jobListingDetail): void
    {
        $jobListing = $this->jobListingRepository->findById($jobListingDetail->job_listing_id);

        if(!empty($jobListing)){
            dispatch(new DeleteRecordJobListing($jobListing));
        }
    }
}
