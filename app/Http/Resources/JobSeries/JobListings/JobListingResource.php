<?php

namespace App\Http\Resources\JobSeries\JobListings;

use App\Http\Resources\CompanySeries\CompanyProfile\CompanyProfileResource;
use App\Http\Resources\DefaultSeries\DefaultGender\DefaultGenderResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'company' => CompanyProfileResource::make($this->companies),
            'title' => $this->title,
            'slug' => $this->slug,
            'quantity_recruitment' => $this->quantity_recruitment,
            'gender' => DefaultGenderResource::make($this->gender),
            'expiry_date' => formatDate($this->expiry_date),
            'view' => $this->view,
        ];
    }
}
