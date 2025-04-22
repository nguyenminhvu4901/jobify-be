<?php

namespace App\Http\Resources\JobSeries\JobListings;

use App\Http\Resources\DefaultSeries\DefaultGender\DefaultGenderResource;
use App\Http\Resources\DefaultSeries\DefaultStatus\DefaultStatusResource;
use App\Http\Resources\JobSeries\JobAgeRanges\JobAgeRangeResource;
use App\Http\Resources\JobSeries\JobContact\JobContactResource;
use App\Http\Resources\JobSeries\JobEducationLevel\JobEducationLevelResource;
use App\Http\Resources\JobSeries\JobExperience\JobExperienceResource;
use App\Http\Resources\JobSeries\JobLevel\JobLevelResource;
use App\Http\Resources\JobSeries\JobLocation\JobLocationResource;
use App\Http\Resources\JobSeries\JobModerationStatus\JobModerationStatusWithPivotResource;
use App\Http\Resources\JobSeries\JobPosition\JobPositionResource;
use App\Http\Resources\JobSeries\JobSalary\JobSalaryResource;
use App\Http\Resources\JobSeries\JobTypes\JobTypeResource;
use App\Http\Resources\JobSeries\JobVisibilityStatus\JobVisibilityStatusResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\JobSeries\JobListingDetail\JobListingDetailResource;

class JobListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'company' => JobCompanyResource::make($this->companies),

            'title' => $this->title,
            'slug' => $this->slug,
            'quantity_recruitment' => $this->quantity_recruitment,
            'gender' => DefaultGenderResource::make($this->gender),
            'publish_date' => formatDate($this->publish_date),
            'expiry_date' => formatDate($this->expiry_date),

            'active_status' => DefaultStatusResource::make($this->status),
            'job_visibility_status' => JobVisibilityStatusResource::make($this->jobVisibilityStatus),
            'job_moderation_status' => JobModerationStatusWithPivotResource::collection($this->jobModerationStatus),

            'job_listing_detail' => JobListingDetailResource::make($this->jobListingDetail),

            'job_salaries' => JobSalaryResource::make($this->jobSalaries),
            'job_positions' => JobPositionResource::collection($this->positions),
            'job_contact' => JobContactResource::collection($this->jobContact),
            'job_locations' => JobLocationResource::collection($this->jobLocation),

            'job_age_ranges' => JobAgeRangeResource::make($this->jobAgeRanges),
            'job_types' => JobTypeResource::make($this->jobTypes),
            'job_levels' => JobLevelResource::make($this->jobLevels),
            'job_experiences' => JobExperienceResource::make($this->jobExperiences),
            'job_education_levels' => JobEducationLevelResource::make($this?->jobEducationLevels),

        ];
    }
}
