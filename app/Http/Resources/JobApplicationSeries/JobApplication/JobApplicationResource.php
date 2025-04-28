<?php

namespace App\Http\Resources\JobApplicationSeries\JobApplication;

use App\Http\Resources\Auth\UserResource;
use App\Http\Resources\JobApplicationSeries\ApplicationCV\ApplicationCVResource;
use App\Http\Resources\JobApplicationSeries\ApplicationStatus\ApplicationStatusResource;
use App\Http\Resources\JobSeries\JobListings\JobListingResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicationResource extends JsonResource
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
            'user' => UserResource::make($this->users),
            'job_listing' => JobListingResource::make($this->jobListings),
            'applied_at' => formatDate($this->applied_at),
            'cover_letter' => $this->cover_letter,
            'application_statuses' => JobApplicationStatusResource::collection($this->applicationStatuses),
            'application_cv' => ApplicationCVResource::collection($this->applicationCV),
        ];
    }
}
