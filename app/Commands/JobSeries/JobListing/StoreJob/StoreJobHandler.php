<?php

namespace App\Commands\JobSeries\JobListing\StoreJob;

use App\Repositories\JobSeries\JobListing\JobListingRepository;

class StoreJobHandler
{
    public function __construct(
        JobListingRepository $jobListingRepository
    )
    {
    }

    public function handle(StoreJobCommand $command)
    {
        try {

        }catch (\Exception $e){

            return [
                'message' => __('messages.job.job_update_profile_error'),
                'error' => $e
            ];
        }
    }

    private function JobListingCompany(StoreJobCommand $command): array
    {
        return [
            'company_id' => $command->companyId,
            'title' => $command->title,
            'quantity_recruitment' => $command->quantityRecruitment,
            'gender_id' => $command->genderId,
            'publish_date' => $command->publishDate,
            'expiry_date' => $command->expiryDate,

        ];
    }
}
