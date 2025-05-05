<?php

namespace App\DataTransferObjects\Searchable\JobSeries\JobListings;

use App\DataTransferObjects\Searchable\CompanySeries\Companies\CompanySearchableDTO;
use App\DataTransferObjects\Searchable\Default\GenderDTO;
use App\DataTransferObjects\Searchable\Default\StatusDTO;
use App\DataTransferObjects\Searchable\JobSeries\JobAgeRanges\JobAgeRangeDTO;
use App\DataTransferObjects\Searchable\JobSeries\JobContacts\JobContactDTO;
use App\DataTransferObjects\Searchable\JobSeries\JobEducationLevels\JobEducationLevelDTO;
use App\DataTransferObjects\Searchable\JobSeries\JobExperiences\JobExperienceDTO;
use App\DataTransferObjects\Searchable\JobSeries\JobLevels\JobLevelDTO;
use App\DataTransferObjects\Searchable\JobSeries\JobListingDetails\JobListingDetailDTO;
use App\DataTransferObjects\Searchable\JobSeries\JobLocations\JobLocationDTO;
use App\DataTransferObjects\Searchable\JobSeries\JobModerationStatuses\JobModerationStatusSearchableDTO;
use App\DataTransferObjects\Searchable\JobSeries\JobPositions\JobPositionDTO;
use App\DataTransferObjects\Searchable\JobSeries\JobSalaries\JobSalaryDTO;
use App\DataTransferObjects\Searchable\JobSeries\JobTypes\JobTypeDTO;
use App\DataTransferObjects\Searchable\JobSeries\JobVisibilityStatuses\JobVisibilityStatusSearchableDTO;
use App\Entities\JobSeries\JobListing\JobListing;

class JobListingSearchableDTO
{
    public static function prepareSearchableToArray(JobListing $jobListing): array
    {
        return [
            'id' => $jobListing->id,
            'title' => $jobListing->title,
            'slug' => $jobListing->slug,
            'quantity_recruitment' => $jobListing->quantity_recruitment,
            'publish_date' => formatDate($jobListing->publish_date),
            'expiry_date' => formatDate($jobListing->expiry_date),
            'gender' => optional($jobListing->gender, fn($g) => GenderDTO::formatGender($g)),

            'active_status' => optional($jobListing->status, fn($status) => StatusDTO::formatStatus($status)),

            'job_visibility_status' => optional($jobListing->jobVisibilityStatus,
                fn($status) => JobVisibilityStatusSearchableDTO::formatVisibilityStatus($status)),

            'job_moderation_status' => $jobListing->jobModerationStatus->map(
                fn($status) => JobModerationStatusSearchableDTO::formatModerationStatus($status))
                ->values()->toArray(),

            'job_listing_detail' => optional($jobListing->jobListingDetail, fn($d) =>
                JobListingDetailDTO::formatJobDetail($d)),

            'job_salaries' => $jobListing->jobSalaries->map(
                fn($salary) => JobSalaryDTO::formatJobSalary($salary))
                ->values()->toArray(),

            'job_positions' => $jobListing->positions->map(
                fn($position) => JobPositionDTO::formatJobPosition($position))
                ->values()->toArray(),

            'job_contact' => $jobListing->jobContact->map(
                fn($contact) => JobContactDTO::formatJobContact($contact))->values()->toArray(),

            'job_locations' => $jobListing->jobLocation->map(
                fn($location) => JobLocationDTO::formatJobLocation($location))
                ->values()->toArray(),

            'job_age_ranges' => optional($jobListing->jobAgeRanges,
                fn($ageRange) => JobAgeRangeDTO::formatJobAgeRange($ageRange)),

            'job_types' => optional($jobListing->jobTypes, fn($jt) => JobTypeDTO::formatJobType($jt)),

            'job_levels' => optional($jobListing->jobLevels, fn($jl) => JobLevelDTO::formatJobLevel($jl)),

            'job_experiences' => optional($jobListing->jobExperiences,
                fn($je) => JobExperienceDTO::formatExperience($je)),

            'job_education_levels' => optional($jobListing->jobEducationLevels,
                fn($ed) => JobEducationLevelDTO::formatEducationLevel($ed)),

            'company' => optional($jobListing->companies, fn($company) => CompanySearchableDTO::formatCompany($company)),
        ];
    }
}
