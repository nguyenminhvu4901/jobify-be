<?php

namespace App\Commands\JobSeries\JobListing\StoreJob;

use App\Commands\CommandInterface;
use App\DataTransferObjects\JobSeries\JobContacts\StoreJobContactData;
use App\DataTransferObjects\JobSeries\JobListingDetails\StoreJobListingDetailData;
use App\DataTransferObjects\JobSeries\JobLocations\StoreJobLocationData;
use App\DataTransferObjects\JobSeries\JobSalaries\StoreJobSalaryData;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

readonly class StoreJobCommand implements CommandInterface
{
    public function __construct(
        public int $companyId,
        public string $title,
        public int $quantityRecruitment,
        public int $genderId,
        public Carbon $publishDate,
        public Carbon $expiryDate,

        /** @var StoreJobSalaryData[]|null */
        public array|null $jobSalaries,

        public int $jobVisibilityStatusId,

        public int|null $jobTypeId,
        public int|null $jobLevelId,
        public int|null $jobExperienceId,
        public int|null $jobAgeRangeId,
        public int|null $jobEducationLevelId,

        /** @var StoreJobLocationData[]|null */
        public array|null $jobLocations,
        public int $jobPositionMainId,
        public array|null $jobPositionSecondary,

        /** @var StoreJobContactData[]|null */
        public array|null $jobContacts,

        /** @var StoreJobListingDetailData[]|null */
        public array|null $jobListingDetails,
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        $jobSalaries = $request->input('job_salaries');
        $jobLocations = $request->input('job_locations');
        $jobContacts = $request->input('job_contacts');
        $jobListingDetails = $request->input('job_listing_details');


        return new self(
           companyId: $request->input('company_id'),
           title: $request->input('title'),
           quantityRecruitment: $request->input('quantity_recruitment'),
           genderId: $request->input('gender_id'),
           publishDate: Carbon::createFromFormat('Y-m-d', $request->input('publish_date')),
           expiryDate: Carbon::createFromFormat('Y-m-d', $request->input('expiry_date')),

           jobSalaries: $jobSalaries
               ? collect($jobSalaries)
                   ->map(fn ($item) => StoreJobSalaryData::fromArray($item))
                   ->all()
               : null,

            jobVisibilityStatusId: $request->input('job_visibility_status_id'),

           jobTypeId: $request->input('job_type_id'),
           jobLevelId: $request->input('job_level_id'),
           jobExperienceId: $request->input('job_experience_id'),
           jobAgeRangeId: $request->input('job_age_range_id'),
           jobEducationLevelId: $request->input('job_education_level_id'),

           jobLocations: $jobLocations
               ? collect($jobLocations)
                   ->map(fn ($item) => StoreJobLocationData::fromArray($item))
                   ->all()
               : null,

           jobPositionMainId: $request->input('job_position_main_id'),
           jobPositionSecondary: $request->input('job_position_secondary'),

           jobContacts: $jobContacts
                ? collect($jobContacts)
                    ->map(fn ($item) => StoreJobContactData::fromArray($item))
                    ->all()
                : null,

           jobListingDetails: $jobListingDetails
                ? collect($jobListingDetails)
                    ->map(fn ($item) => StoreJobListingDetailData::fromArray($item))
                    ->all()
                : null,
        );
    }
}
