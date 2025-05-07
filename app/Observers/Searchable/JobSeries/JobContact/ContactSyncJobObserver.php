<?php

namespace App\Observers\Searchable\JobSeries\JobContact;

use App\Entities\JobSeries\JobContact\JobContact;
use App\Jobs\Searchable\JobListing\DeleteRecordJobListing;
use App\Jobs\Searchable\JobListing\ReindexJobListing;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Services\Observer\ObserverFlag;

class ContactSyncJobObserver
{
    public function __construct(
        protected JobListingRepository $jobListingRepository,
        protected ObserverFlag $flag
    )
    {
    }

    /**
     * @param JobContact $jobContact
     * @return void
     */
    public function created(JobContact $jobContact): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobContact);
    }

    /**
     * @param JobContact $jobContact
     * @return void
     */
    public function updated(JobContact $jobContact): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobContact);
    }

    /**
     * @param JobContact $jobContact
     * @return void
     */
    public function saved(JobContact $jobContact): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobContact);
    }

    /**
     * @param JobContact $jobContact
     * @return void
     */
    public function deleted(JobContact $jobContact): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($jobContact);
    }

    /**
     * @param JobContact $jobContact
     * @return void
     */
    public function restored(JobContact $jobContact): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobContact);
    }

    /**
     * @param JobContact $jobContact
     * @return void
     */
    public function forceDeleted(JobContact $jobContact): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($jobContact);
    }

    /**
     * @param JobContact $jobContact
     * @return void
     */
    private function dispatchReindexJobs(JobContact $jobContact): void
    {
        $jobListing = $this->jobListingRepository->findById($jobContact->job_listing_id);

        if(!empty($jobListing)){
            dispatch(new ReindexJobListing($jobListing));
        }
    }

    /**
     * @param JobContact $jobContact
     * @return void
     */
    private function dispatchDeleteJobs(JobContact $jobContact): void
    {
        $jobListing = $this->jobListingRepository->findById($jobContact->job_listing_id);

        if(!empty($jobListing)){
            dispatch(new DeleteRecordJobListing($jobListing));
        }
    }
}
