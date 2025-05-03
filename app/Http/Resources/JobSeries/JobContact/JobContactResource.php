<?php

namespace App\Http\Resources\JobSeries\JobContact;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobContactResource extends JsonResource
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
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
        ];
    }
}
