<?php

namespace App\Observers\Searchable\CompanySeries\CompanyBusinessSector;

use App\Entities\CompanySeries\CompanyBusinessSector\CompanyBusinessSector;
use App\Entities\JobSeries\JobListing\JobListing;
use App\Jobs\Searchable\JobListing\DeleteRecordJobListing;
use App\Jobs\Searchable\JobListing\ReindexJobListing;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Services\Observer\ObserverFlag;

class BusinessSectorSyncJobObserver
{
    public function __construct(
        protected JobListingRepository $jobListingRepository,
        protected ObserverFlag $flag
    )
    {
    }

    /**
     * @param CompanyBusinessSector $companyBusinessSector
     * @return void
     */
    public function created(CompanyBusinessSector $companyBusinessSector): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($companyBusinessSector);
    }

    /**
     * @param CompanyBusinessSector $companyBusinessSector
     * @return void
     */
    public function updated(CompanyBusinessSector $companyBusinessSector): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($companyBusinessSector);
    }

    /**
     * @param CompanyBusinessSector $companyBusinessSector
     * @return void
     */
    public function saved(CompanyBusinessSector $companyBusinessSector): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($companyBusinessSector);
    }

    /**
     * @param CompanyBusinessSector $companyBusinessSector
     * @return void
     */
    public function restored(CompanyBusinessSector $companyBusinessSector): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($companyBusinessSector);
    }

    /**
     * @param CompanyBusinessSector $companyBusinessSector
     * @return void
     */
    public function deleted(CompanyBusinessSector $companyBusinessSector): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($companyBusinessSector);
    }

    /**
     * @param CompanyBusinessSector $companyBusinessSector
     * @return void
     */
    public function forceDeleted(CompanyBusinessSector $companyBusinessSector): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($companyBusinessSector);
    }

    /**
     * @param CompanyBusinessSector $companyBusinessSector
     * @return void
     */
    private function dispatchReindexJobs(CompanyBusinessSector $companyBusinessSector): void
    {
        $this->jobListingRepository->whereByCompanyId($companyBusinessSector->company_id)
            ->cursor()
            ->each(fn(JobListing $job) => dispatch(new ReindexJobListing($job)));
    }

    /**
     * @param CompanyBusinessSector $companyBusinessSector
     * @return void
     */
    private function dispatchDeleteJobs(CompanyBusinessSector $companyBusinessSector): void
    {
        $this->jobListingRepository->whereByCompanyId($companyBusinessSector->company_id)
            ->cursor()
            ->each(fn(JobListing $job) => dispatch(new DeleteRecordJobListing($job)));
    }
}
