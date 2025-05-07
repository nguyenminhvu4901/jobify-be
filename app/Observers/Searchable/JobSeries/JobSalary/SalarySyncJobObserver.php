<?php

namespace App\Observers\Searchable\JobSeries\JobSalary;

use App\Entities\JobSeries\JobSalary\JobSalary;
use App\Jobs\Searchable\JobListing\DeleteRecordJobListing;
use App\Jobs\Searchable\JobListing\ReindexJobListing;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Services\Observer\ObserverFlag;

class SalarySyncJobObserver
{
    /**
     * @param JobListingRepository $jobListingRepository
     * @param ObserverFlag $flag
     */
    public function __construct(
        protected JobListingRepository $jobListingRepository,
        protected ObserverFlag $flag
    )
    {
    }

    /**
     * @param JobSalary $jobSalary
     * @return void
     */
    public function created(JobSalary $jobSalary): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobSalary);
    }

    /**
     * @param JobSalary $jobSalary
     * @return void
     */
    public function updated(JobSalary $jobSalary): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobSalary);
    }

    /**
     * @param JobSalary $jobSalary
     * @return void
     */
    public function saved(JobSalary $jobSalary): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobSalary);
    }

    /**
     * @param JobSalary $jobSalary
     * @return void
     */
    public function deleted(JobSalary $jobSalary): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($jobSalary);
    }

    /**
     * @param JobSalary $jobSalary
     * @return void
     */
    public function restored(JobSalary $jobSalary): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($jobSalary);
    }

    /**
     * @param JobSalary $jobSalary
     * @return void
     */
    public function forceDeleted(JobSalary $jobSalary): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($jobSalary);
    }

    /**
     * @param JobSalary $jobSalary
     * @return void
     */
    private function dispatchReindexJobs(JobSalary $jobSalary): void
    {
        $jobListing = $this->jobListingRepository->findById($jobSalary->job_listing_id);

        if(!empty($jobListing)){
            dispatch(new ReindexJobListing($jobListing));
        }
    }

    /**
     * @param JobSalary $jobSalary
     * @return void
     */
    private function dispatchDeleteJobs(JobSalary $jobSalary): void
    {
        $jobListing = $this->jobListingRepository->findById($jobSalary->job_listing_id);

        if(!empty($jobListing)){
            dispatch(new DeleteRecordJobListing($jobListing));
        }
    }
}
