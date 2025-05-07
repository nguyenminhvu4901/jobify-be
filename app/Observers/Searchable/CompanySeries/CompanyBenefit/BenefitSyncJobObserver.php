<?php

namespace App\Observers\Searchable\CompanySeries\CompanyBenefit;

use App\Entities\CompanySeries\CompanyBenefit\CompanyBenefit;
use App\Entities\JobSeries\JobListing\JobListing;
use App\Jobs\Searchable\JobListing\DeleteRecordJobListing;
use App\Jobs\Searchable\JobListing\ReindexJobListing;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Services\Observer\ObserverFlag;

class BenefitSyncJobObserver
{
    public function __construct(
        protected JobListingRepository $jobListingRepository,
        protected ObserverFlag $flag
    )
    {
    }

    /**
     * @param CompanyBenefit $companyBenefit
     * @return void
     */
    public function created(CompanyBenefit $companyBenefit): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($companyBenefit);
    }

    /**
     * @param CompanyBenefit $companyBenefit
     * @return void
     */
    public function updated(CompanyBenefit $companyBenefit): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($companyBenefit);
    }

    /**
     * @param CompanyBenefit $companyBenefit
     * @return void
     */
    public function saved(CompanyBenefit $companyBenefit): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($companyBenefit);
    }

    /**
     * @param CompanyBenefit $companyBenefit
     * @return void
     */
    public function restored(CompanyBenefit $companyBenefit): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($companyBenefit);
    }

    /**
     * @param CompanyBenefit $companyBenefit
     * @return void
     */
    public function deleted(CompanyBenefit $companyBenefit): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($companyBenefit);
    }

    /**
     * @param CompanyBenefit $companyBenefit
     * @return void
     */
    public function forceDeleted(CompanyBenefit $companyBenefit): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($companyBenefit);
    }

    /**
     * @param CompanyBenefit $companyBenefit
     * @return void
     */
    private function dispatchReindexJobs(CompanyBenefit $companyBenefit): void
    {
        $this->jobListingRepository->whereByCompanyId($companyBenefit->company_id)
            ->cursor()
            ->each(fn(JobListing $job) => dispatch(new ReindexJobListing($job)));
    }

    /**
     * @param CompanyBenefit $companyBenefit
     * @return void
     */
    private function dispatchDeleteJobs(CompanyBenefit $companyBenefit): void
    {
        $this->jobListingRepository->whereByCompanyId($companyBenefit->company_id)
            ->cursor()
            ->each(fn(JobListing $job) => dispatch(new DeleteRecordJobListing($job)));
    }
}
