<?php

namespace App\Observers\Searchable\CompanySeries\CompanyOperationType;

use App\Entities\CompanySeries\CompanyOperationType\CompanyOperationType;
use App\Entities\JobSeries\JobListing\JobListing;
use App\Jobs\Searchable\JobListing\DeleteRecordJobListing;
use App\Jobs\Searchable\JobListing\ReindexJobListing;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Services\Observer\ObserverFlag;

class OperationTypeSyncJobObserver
{
    public function __construct(
        protected JobListingRepository $jobListingRepository,
        protected ObserverFlag $flag
    )
    {
    }

    /**
     * @param CompanyOperationType $companyOperationType
     * @return void
     */
    public function created(CompanyOperationType $companyOperationType): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($companyOperationType);
    }

    /**
     * @param CompanyOperationType $companyOperationType
     * @return void
     */
    public function updated(CompanyOperationType $companyOperationType): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($companyOperationType);
    }

    /**
     * @param CompanyOperationType $companyOperationType
     * @return void
     */
    public function saved(CompanyOperationType $companyOperationType): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($companyOperationType);
    }

    /**
     * @param CompanyOperationType $companyOperationType
     * @return void
     */
    public function restored(CompanyOperationType $companyOperationType): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($companyOperationType);
    }

    /**
     * @param CompanyOperationType $companyOperationType
     * @return void
     */
    public function deleted(CompanyOperationType $companyOperationType): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($companyOperationType);
    }

    /**
     * @param CompanyOperationType $companyOperationType
     * @return void
     */
    public function forceDeleted(CompanyOperationType $companyOperationType): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($companyOperationType);
    }

    /**
     * @param CompanyOperationType $companyOperationType
     * @return void
     */
    private function dispatchReindexJobs(CompanyOperationType $companyOperationType): void
    {
        $this->jobListingRepository->whereByCompanyId($companyOperationType->company_id)
            ->cursor()
            ->each(fn(JobListing $job) => dispatch(new ReindexJobListing($job)));
    }

    /**
     * @param CompanyOperationType $companyOperationType
     * @return void
     */
    private function dispatchDeleteJobs(CompanyOperationType $companyOperationType): void
    {
        $this->jobListingRepository->whereByCompanyId($companyOperationType->company_id)
            ->cursor()
            ->each(fn(JobListing $job) => dispatch(new DeleteRecordJobListing($job)));
    }
}
