<?php

namespace App\Http\Resources\JobApplicationSeries\ApplicationStatus;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobApplicationStatusResource extends JsonResource
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
            'job_application_id' => $this->job_application_id,
            'application_status' => ApplicationStatusResource::make($this->applicationStatuses),
            'reject_reason' => $this->reject_reason,
            'hired_at' => formatDate($this->hired_at)
        ];
    }
}
