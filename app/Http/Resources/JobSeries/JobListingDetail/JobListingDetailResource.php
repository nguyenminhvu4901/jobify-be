<?php

namespace App\Http\Resources\JobSeries\JobListingDetail;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobListingDetailResource extends JsonResource
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
            'job_listing_id' => $this->job_listing_id,
            'description' => $this->description,
            'requirement' => $this->requirement,
            'income' => $this->income,
            'benefit' => $this->benefit,
            'working_hour' => $this->working_hour,
        ];
    }
}
