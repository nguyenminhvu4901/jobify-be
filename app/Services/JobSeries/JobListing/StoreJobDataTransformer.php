<?php

namespace App\Services\JobSeries\JobListing;

use App\Commands\JobSeries\JobListing\StoreJob\StoreJobCommand;
use App\DataTransferObjects\JobSeries\JobContacts\StoreJobContactData;
use App\DataTransferObjects\JobSeries\JobListingDetails\StoreJobListingDetailData;
use App\DataTransferObjects\JobSeries\JobLocations\StoreJobLocationData;
use App\DataTransferObjects\JobSeries\JobSalaries\StoreJobSalaryData;
use App\Enums\StatusEnum;

class StoreJobDataTransformer
{
    public function jobListingCompany(
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
            'job_level_id' => $command->job_level_id ?? null,
            'job_experience_id' => $command->job_experience_id ?? null,
            'job_age_range_id' => $command->job_age_range_id ?? null,
            'job_education_level_id' => $command->job_education_level_id ?? null
        ];
    }

    public function jobListingDetail(
        StoreJobListingDetailData $data,
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

    public function jobLocations(
        StoreJobLocationData $data,
        int $jobListingId
    ): array
    {
        return [
            'job_listing_id' => $jobListingId,
            'branch_name' => $data->branchName,
            'province_id' => $data->provinceId,
            'district_id' => $data->districtId,
            'ward' => $data->wardId,
            'address' => $data->address
        ];
    }

    public function jobSalaries(
        StoreJobSalaryData $data
    ): array
    {
        return [
            'currency_id' => $data->currencyId,
            'job_salary_type_id' => $data->jobSalaryTypeId,
            'from' => $data->from,
            'to' => $data->to
        ];
    }

    //Main, Seconds
    public function jobPosition(

    ): array
    {
        return [

        ];
    }

    public function jobContacts(
        StoreJobContactData $data,
        int $jobListingId
    ): array
    {
        return [
            'job_listing_id' => $jobListingId,
            'full_name' => $data->fullName,
            'email' => $data->email,
            'phone_number' => $data->phoneNumber
        ];
    }
}
