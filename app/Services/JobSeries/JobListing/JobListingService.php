<?php

namespace App\Services\JobSeries\JobListing;

use App\Commands\JobSeries\JobListing\StoreJob\StoreJobCommand;
use App\Commands\JobSeries\JobListing\UpdateJob\UpdateJobCommand;
use App\Enums\StatusEnum;
use App\Repositories\JobSeries\JobListing\JobListingRepository;

class JobListingService
{
    /**
     * @param JobListingRepository $jobListingRepository
     */
    public function __construct(
        protected JobListingRepository $jobListingRepository
    )
    {
    }

    /**
     * @param StoreJobCommand $command
     * @return array
     */
    public function storeJobListing(
        StoreJobCommand $command
    ): array
    {
        return $this->jobListingRepository->storeDataWithTransaction(
            $this->jobListingTransformer($command)
        );
    }

    /**
     * @param UpdateJobCommand $command
     * @return array
     */
    public function updateJobListing(
        UpdateJobCommand $command
    ): array
    {
        return $this->jobListingRepository->updateDataWithTransaction(
            $this->jobListingTransformer($command),
            $command->jobListingId
        );
    }

    /**
     * @param StoreJobCommand|UpdateJobCommand $command
     * @return array
     */
    private function jobListingTransformer(
        StoreJobCommand|UpdateJobCommand $command
    ): array
    {
        return [
            'company_id' => $command->companyId,
            'title' => $command->title,
            'quantity_recruitment' => $command->quantityRecruitment,
            'gender_id' => $command->genderId,
            'publish_date' => $command->publishDate,
            'expiry_date' => $command->expiryDate,
            'active_status_id' => StatusEnum::ACTIVE->value,
            'job_visibility_status_id' => $command->jobVisibilityStatusId,
            'job_type_id' => $command->jobTypeId ?? null,
            'job_level_id' => $command->jobLevelId ?? null,
            'job_experience_id' => $command->jobExperienceId ?? null,
            'job_age_range_id' => $command->jobAgeRangeId ?? null,
            'job_education_level_id' => $command->jobEducationLevelId ?? null,
            'min_age' => $command->minAge ?? null,
            'max_age' => $command->maxAge ?? null
        ];
    }
}
