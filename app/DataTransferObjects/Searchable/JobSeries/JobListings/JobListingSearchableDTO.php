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

    public static function prepareMappableAs(): array
    {
        return [
            'id' => 'keyword',
            'title' => 'text',
            'slug' => 'keyword',
            'quantity_recruitment' => 'integer',
            'publish_date' => 'date',
            'expiry_date' => 'date',

            'gender' => [
                'id' => 'keyword',
                'gender' => 'keyword',
            ],

            'active_status' => [
                'id' => 'keyword',
                'status' => 'keyword',
            ],

            'job_visibility_status' => [
                'id' => 'keyword',
                'name' => 'keyword',
            ],

            'job_moderation_status' => [
                'id' => 'keyword',
                'name' => 'keyword',
            ],

            'job_listing_detail' => [
                'id' => 'keyword',
                'job_listing_id' => 'integer',
                'description' => 'text',
                'requirement' => 'text',
                'income' => 'text',
                'benefit' => 'text',
                'working_hour' => 'text',
            ],

            'job_salaries' => [
                'id' => 'keyword',
                'job_listing_id' => 'integer',
                'currency' => [
                    'id' => 'keyword',
                    'name' => 'keyword',
                ],
                'job_salary_type' => [
                    'id' => 'keyword',
                    'name' => 'keyword',
                ],
                'from' => 'float',
                'to' => 'float'
            ],

            'job_positions' => [
                'id' => 'keyword',
                'name' => 'text',
                'priority' => 'integer',
            ],

            'job_contact' => [
                'id' => 'keyword',
                'job_listing_id' => 'integer',
                'full_name' => 'text',
                'email' => 'text',
                'phone_number' => 'text'
            ],

            'job_locations' => [
                'id' => 'keyword',
                'job_listing_id' => 'integer',
                'branch_name' => 'text',
                'province' => [
                    'id' => 'keyword',
                    'code' => 'text'
                ],
                'district' => [
                    'id' => 'keyword',
                    'code' => 'text',
                ],
                'ward' => [
                    'id' => 'keyword',
                    'code' => 'text',
                ],
                'address' => 'text'
            ],

            'job_age_ranges' => [
                'id' => 'keyword',
                'min_age' => 'integer',
                'max_age' => 'integer',
                'display' => 'text'
            ],

            'job_types' => [
                'id' => 'keyword',
                'type' => 'text',
            ],

            'job_levels' => [
                'id' => 'keyword',
                'title' => 'text',
                'description' => 'text'
            ],

            'job_experiences' => [
                'id' => 'keyword',
                'name' => 'text',
            ],

            'job_education_levels' => [
                'id' => 'keyword',
                'name' => 'text',
            ],

            'company' => [
                'id' => 'keyword',
                'user_id' => 'keyword',
                'name' => 'text',
                'slug' => 'keyword',
                'tax_code' => 'text',

                'company_scale' => [
                    'id' => 'keyword',
                    'name' => 'text',
                    'description' => 'text',
                    'display' => 'text'
                ],

                'gender' => [
                    'id' => 'keyword',
                    'gender' => 'keyword',
                ],

                'company_status' => [
                    'id' => 'keyword',
                    'status' => 'keyword',
                ],

                'company_working_day' => [
                    'id' => 'keyword',
                    'working_day' => 'keyword',
                ],

                'website' => 'text',
                'description' => 'text',
                'avatar' => 'text',

                'company_branches' => [
                    'id' => 'keyword',
                    'company_id' => 'integer',
                    'branch_name' => 'text',
                    'province' => [
                        'id' => 'keyword',
                        'code' => 'text'
                    ],
                    'district' => [
                        'id' => 'keyword',
                        'code' => 'text',
                    ],
                    'ward' => [
                        'id' => 'keyword',
                        'code' => 'text',
                    ],
                    'address' => 'text'
                ],

                'operation_types' => [
                    'id' => 'keyword',
                    'name' => 'text',
                    'description' => 'text'
                ],

                'business_sectors' => [
                    'id' => 'keyword',
                    'name' => 'text',
                    'description' => 'text'
                ],

                'company_benefits' => [
                    'id' => 'keyword',
                    'company_id' => 'keyword',
                    'benefit_name' => 'text',
                    'description' => 'text'
                ]
            ]
        ];
    }
}
