<?php

namespace App\Commands\JobSeries\JobListing\StoreJob;

use App\Commands\CommandInterface;
use App\DataTransferObjects\JobSeries\JobContacts\JobContactData;
use App\DataTransferObjects\JobSeries\JobListingDetails\JobListingDetailData;
use App\DataTransferObjects\JobSeries\JobLocations\JobLocationData;
use App\DataTransferObjects\JobSeries\Salaries\SalaryData;
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

        /** @var SalaryData[]|null */
        public array|null $jobSalaries,

        public int $jobVisibilityStatusId,

        public int|null $jobTypeId,
        public int|null $jobLevelId,
        public int|null $jobExperienceId,
        public int|null $jobAgeRangeId,
        public int|null $jobEducationLevelId,

        /** @var JobLocationData[]|null */
        public array|null $jobLocations,
        public int $jobPositionMainId,
        public array|null $jobPositionSecondary,

        /** @var JobContactData[]|null */
        public array|null $jobContacts,

        /** @var JobListingDetailData[]|null */
        public array|null $jobListingDetails,

        public int|null $minAge,
        public int|null $maxAge
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
                   ->map(fn ($item) => SalaryData::fromArray($item))
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
                   ->map(fn ($item) => JobLocationData::fromArray($item))
                   ->all()
               : null,

           jobPositionMainId: $request->input('job_position_main_id'),
           jobPositionSecondary: $request->input('job_position_secondary'),

           jobContacts: $jobContacts
                ? collect($jobContacts)
                    ->map(fn ($item) => JobContactData::fromArray($item))
                    ->all()
                : null,

           jobListingDetails: $jobListingDetails
                ? collect($jobListingDetails)
                    ->map(fn ($item) => JobListingDetailData::fromArray($item))
                    ->all()
                : null,

           minAge: $request->input('min_age'),
           maxAge: $request->input('max_age')
        );
    }
}
