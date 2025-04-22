<?php

namespace App\Services\JobSeries\JobListing;

use App\Commands\JobSeries\JobListing\StoreJob\StoreJobCommand;
use App\DataTransferObjects\JobSeries\JobContacts\StoreJobContactData;
use App\DataTransferObjects\JobSeries\JobListingDetails\StoreJobListingDetailData;
use App\DataTransferObjects\JobSeries\JobLocations\StoreJobLocationData;
use App\DataTransferObjects\JobSeries\JobSalaries\StoreJobSalaryData;
use App\Enums\RouteNames\JobSeries\PositionEnum;
use App\Enums\StatusEnum;
use App\Repositories\JobSeries\JobContact\JobContactRepository;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Repositories\JobSeries\JobListingDetail\JobListingDetailRepository;
use App\Repositories\JobSeries\JobLocation\JobLocationRepository;
use App\Repositories\JobSeries\JobPosition\JobPositionRepository;
use App\Repositories\JobSeries\JobSalary\JobSalaryRepository;

class StoreJobDataTransformer
{
    /**
     * @param JobSalaryRepository $jobSalaryRepository
     * @param JobListingRepository $jobListingRepository
     * @param JobLocationRepository $jobLocationRepository
     * @param JobContactRepository $jobContactRepository
     * @param JobListingDetailRepository $jobListingDetailRepository
     * @param JobPositionRepository $jobPositionRepository
     */
    public function __construct(
        protected JobSalaryRepository $jobSalaryRepository,
        protected JobListingRepository $jobListingRepository,
        protected JobLocationRepository $jobLocationRepository,
        protected JobContactRepository $jobContactRepository,
        protected JobListingDetailRepository $jobListingDetailRepository,
        protected JobPositionRepository $jobPositionRepository
    )
    {
    }

    /**
     * @param StoreJobSalaryData|array|null $jobSalaryData
     * @return array|null
     */
    public function storeJobSalary(
        StoreJobSalaryData|array|null $jobSalaryData): ?array
    {
        $jobSalary = null;
        if(!empty($jobSalaryData)){
            $jobSalary = $this->jobSalaryRepository->storeDataWithTransaction(
                $this->jobSalaryTransformer($jobSalaryData[0] ?? null)
            );
        }

        return $jobSalary;
    }

    /**
     * @param StoreJobCommand $command
     * @param int|null $jobSalaryId
     * @return array
     */
    public function saveJobListing(
        StoreJobCommand $command,
        int|null $jobSalaryId
    ): array
    {
        return $this->jobListingRepository->storeDataWithTransaction(
            $this->jobListingTransformer($command, $jobSalaryId)
        );
    }

    /**
     * @param StoreJobLocationData|array|null $storeJobLocationData
     * @param int $jobListingId
     * @return array
     */
    public function saveJobLocations(
        StoreJobLocationData|null|array $storeJobLocationData,
        int $jobListingId
    ): array
    {
        return $this->jobLocationRepository->insertTransaction(
            $this->jobLocations($storeJobLocationData, $jobListingId)
        );
    }

    /**
     * @param StoreJobContactData|array|null $storeJobContactData
     * @param int $jobListingId
     * @return array
     */
    public function saveJobContacts(
        StoreJobContactData|null|array $storeJobContactData,
        int $jobListingId
    ): array
    {
        return $this->jobContactRepository->insertTransaction(
            $this->jobContacts($storeJobContactData, $jobListingId)
        );
    }

    /**
     * @param StoreJobListingDetailData|array|null $storeJobListingDetailData
     * @param int $jobListingId
     * @return array
     */
    public function saveJobListingDetail(
        StoreJobListingDetailData|null|array $storeJobListingDetailData,
        int $jobListingId
    ): array
    {
        return $this->jobListingDetailRepository->storeDataWithTransaction(
            $this->jobListingDetail($storeJobListingDetailData[0] ?? null, $jobListingId)
        );
    }

    /**
     * @param int $jobPositionMainId
     * @param int $jobListingId
     * @param array|null $jobPositionSecondary
     * @return array
     */
    public function saveJobPosition(
        int $jobPositionMainId,
        int $jobListingId,
        array|null $jobPositionSecondary
    ): array
    {
        return $this->jobPositionRepository->insertTransaction(
            array_merge(
                [$this->saveJobPositionMain($jobPositionMainId, $jobListingId)],
                $this->saveJobPositionSecondary($jobListingId, $jobPositionSecondary ?? null)
            )
        );
    }

    /**
     * @param int $jobPositionMainId
     * @param int $jobListingId
     * @return array
     */
    private function saveJobPositionMain(
        int $jobPositionMainId,
        int $jobListingId
    ): array
    {
        return [
            'job_listing_id' => $jobListingId,
            'position_id' => $jobPositionMainId,
            'priority' => PositionEnum::MAIN_PRIORITY->value,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }

    /**
     * @param int $jobListingId
     * @param array|null $jobPositionSecondary
     * @return array
     */
    private function saveJobPositionSecondary(
        int $jobListingId,
        array|null $jobPositionSecondary
    ): array
    {
        $jobPositionSecondaryArray = [];

        if(!empty($jobPositionSecondary)){
            foreach ($jobPositionSecondary as $data){

                $jobPositionSecondaryArray[] = [
                    'job_listing_id' => $jobListingId,
                    'position_id' => $data,
                    'priority' => PositionEnum::SECONDARY_PRIORITY->value,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        return $jobPositionSecondaryArray;
    }

    /**
     * @param StoreJobCommand $command
     * @param int|null $jobSalaryId
     * @return array
     */
    private function jobListingTransformer(
        StoreJobCommand $command,
        int|null $jobSalaryId
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
            'job_salary_id' => $jobSalaryId ?? null,
            'job_type_id' => $command->jobTypeId ?? null,
            'job_level_id' => $command->jobLevelId ?? null,
            'job_experience_id' => $command->jobExperienceId ?? null,
            'job_age_range_id' => $command->jobAgeRangeId ?? null,
            'job_education_level_id' => $command->jobEducationLevelId ?? null,
            'min_age' => $command->minAge ?? null,
            'max_age' => $command->maxAge ?? null
        ];
    }

    /**
     * @param StoreJobListingDetailData|array|null $data
     * @param int $jobListingId
     * @return array
     */
    private function jobListingDetail(
        StoreJobListingDetailData|null|array $data,
        int $jobListingId
    ): array
    {
        return [
            'job_listing_id' => $jobListingId,
            'description' => $data->description,
            'requirement' => $data->requirement,
            'income' => $data->income,
            'benefit' => $data->benefit,
            'working_hour' => $data->working_hour
        ];
    }

    /**
     * @param StoreJobLocationData|array|null $storeJobLocationData
     * @param int $jobListingId
     * @return array
     */
    private function jobLocations(
        StoreJobLocationData|array|null $storeJobLocationData,
        int $jobListingId
    ): array
    {
        $jobLocationArray = [];

        if(!empty($storeJobLocationData)){

            foreach ($storeJobLocationData as $data){
                $jobLocationArray[] = [
                    'job_listing_id' => $jobListingId,
                    'branch_name' => $data->branchName,
                    'province_id' => $data->provinceId,
                    'district_id' => $data->districtId,
                    'ward_id' => $data->wardId,
                    'address' => $data->address,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        return $jobLocationArray;
    }

    /**
     * @param StoreJobSalaryData|null $data
     * @return array|null
     */
    private function jobSalaryTransformer(
        StoreJobSalaryData|null $data
    ): ?array
    {
        if($data instanceof StoreJobSalaryData){

            return [
                'currency_id' => $data->currencyId,
                'job_salary_type_id' => $data->jobSalaryTypeId,
                'from' => $data->from,
                'to' => $data->to
            ];
        }

        return null;
    }

    /**
     * @param StoreJobContactData|array|null $storeJobContactData
     * @param int $jobListingId
     * @return array
     */
    private function jobContacts(
        StoreJobContactData|array|null $storeJobContactData,
        int $jobListingId
    ): array
    {
        $jobContactArray = [];

        if(!empty($storeJobContactData)) {
            foreach ($storeJobContactData as $data){
                $jobContactArray[] = [
                    'job_listing_id' => $jobListingId,
                    'full_name' => $data->fullName,
                    'email' => $data->email,
                    'phone_number' => $data->phoneNumber,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }
        }

        return $jobContactArray;
    }
}
