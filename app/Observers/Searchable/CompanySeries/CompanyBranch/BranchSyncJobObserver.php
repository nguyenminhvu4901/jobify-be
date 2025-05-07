<?php

namespace App\Observers\Searchable\CompanySeries\CompanyBranch;

use App\Entities\CompanySeries\CompanyBranch\CompanyBranch;
use App\Entities\JobSeries\JobListing\JobListing;
use App\Jobs\Searchable\JobListing\DeleteRecordJobListing;
use App\Jobs\Searchable\JobListing\ReindexJobListing;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Services\Observer\ObserverFlag;

class BranchSyncJobObserver
{
    public function __construct(
        protected JobListingRepository $jobListingRepository,
        protected ObserverFlag $flag
    )
    {
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return void
     */
    public function created(CompanyBranch $companyBranch): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($companyBranch);
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return void
     */
    public function updated(CompanyBranch $companyBranch): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($companyBranch);
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return void
     */
    public function saved(CompanyBranch $companyBranch): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($companyBranch);
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return void
     */
    public function restored(CompanyBranch $companyBranch): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchReindexJobs($companyBranch);
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return void
     */
    public function deleted(CompanyBranch $companyBranch): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($companyBranch);
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return void
     */
    public function forceDeleted(CompanyBranch $companyBranch): void
    {
        if ($this->flag->disabled) {
            return;
        }

        $this->dispatchDeleteJobs($companyBranch);
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return void
     */
    private function dispatchReindexJobs(CompanyBranch $companyBranch): void
    {
        $this->jobListingRepository->whereByCompanyId($companyBranch->company_id)
            ->cursor()
            ->each(fn(JobListing $job) => dispatch(new ReindexJobListing($job)));
    }

    /**
     * @param CompanyBranch $companyBranch
     * @return void
     */
    private function dispatchDeleteJobs(CompanyBranch $companyBranch): void
    {
        $this->jobListingRepository->whereByCompanyId($companyBranch->company_id)
            ->cursor()
            ->each(fn(JobListing $job) => dispatch(new DeleteRecordJobListing($job)));
    }
}
