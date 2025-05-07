<?php

namespace App\Observers\Searchable\CompanySeries\Company;

use App\Entities\CompanySeries\Company\Company;
use App\Entities\JobSeries\JobListing\JobListing;
use App\Jobs\Searchable\JobListing\DeleteRecordJobListing;
use App\Jobs\Searchable\JobListing\ReindexJobListing;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Services\Observer\ObserverFlag;

class CompanySyncJobListingObserver
{
    public function __construct(
        protected JobListingRepository $jobListingRepository,
        protected ObserverFlag $flag
    )
    {
    }

    /**
     * @param Company $company
     * @return void
     */
    public function updated(Company $company): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($company);
    }

    /**
     * @param Company $company
     * @return void
     */
    public function saved(Company $company): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($company);
    }

    /**
     * @param Company $company
     * @return void
     */
    public function restored(Company $company): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($company);
    }

    /**
     * @param Company $company
     * @return void
     */
    public function deleted(Company $company): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($company);
    }

    /**
     * @param Company $company
     * @return void
     */
    public function forceDeleted(Company $company): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($company);
    }

    /**
     * @param Company $company
     * @return void
     */
    private function dispatchReindexJobs(Company $company): void
    {
        $this->jobListingRepository->whereByCompanyId($company->id)
            ->cursor()
            ->each(fn(JobListing $job) => dispatch(new ReindexJobListing($job)));
    }

    /**
     * @param Company $company
     * @return void
     */
    private function dispatchDeleteJobs(Company $company): void
    {
        $this->jobListingRepository->whereByCompanyId($company->id)
            ->cursor()
            ->each(fn(JobListing $job) => dispatch(new DeleteRecordJobListing($job)));
    }
}
