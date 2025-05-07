<?php

namespace App\Observers\Searchable\JobSeries\JobModerationStatusLog;

use App\Entities\JobSeries\JobModerationStatusLog\JobModerationStatusLog;
use App\Jobs\Searchable\JobListing\DeleteRecordJobListing;
use App\Jobs\Searchable\JobListing\ReindexJobListing;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Services\Observer\ObserverFlag;

class ModerationStatusLogSyncJobObserver
{
    public function __construct(
        protected JobListingRepository $jobListingRepository,
        protected ObserverFlag $flag
    )
    {
    }

    /**
     * @param JobModerationStatusLog $jobModerationStatusLog
     * @return void
     */
    public function created(JobModerationStatusLog $jobModerationStatusLog): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobModerationStatusLog);
    }

    /**
     * @param JobModerationStatusLog $jobModerationStatusLog
     * @return void
     */
    public function updated(JobModerationStatusLog $jobModerationStatusLog): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobModerationStatusLog);
    }

    /**
     * @param JobModerationStatusLog $jobModerationStatusLog
     * @return void
     */
    public function saved(JobModerationStatusLog $jobModerationStatusLog): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobModerationStatusLog);
    }

    /**
     * @param JobModerationStatusLog $jobModerationStatusLog
     * @return void
     */
    public function deleted(JobModerationStatusLog $jobModerationStatusLog): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($jobModerationStatusLog);
    }

    /**
     * @param JobModerationStatusLog $jobModerationStatusLog
     * @return void
     */
    public function restored(JobModerationStatusLog $jobModerationStatusLog): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobModerationStatusLog);
    }

    /**
     * @param JobModerationStatusLog $jobModerationStatusLog
     * @return void
     */
    public function forceDeleted(JobModerationStatusLog $jobModerationStatusLog): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($jobModerationStatusLog);
    }

    /**
     * @param JobModerationStatusLog $jobModerationStatusLog
     * @return void
     */
    private function dispatchReindexJobs(JobModerationStatusLog $jobModerationStatusLog): void
    {
        $jobListing = $this->jobListingRepository->findById($jobModerationStatusLog->job_listing_id);

        if(!empty($jobListing)){
            dispatch(new ReindexJobListing($jobListing));
        }
    }

    /**
     * @param JobModerationStatusLog $jobModerationStatusLog
     * @return void
     */
    private function dispatchDeleteJobs(JobModerationStatusLog $jobModerationStatusLog): void
    {
        $jobListing = $this->jobListingRepository->findById($jobModerationStatusLog->job_listing_id);

        if(!empty($jobListing)){
            dispatch(new DeleteRecordJobListing($jobListing));
        }
    }
}
