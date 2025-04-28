<?php

namespace App\Http\Resources\JobApplicationSeries\JobApplication;

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
            'name' => $this->name,
            'description' => $this->description,
            'rejection_reason' => $this->pivot?->rejection_reason,
            'hired_at' => $this->pivot?->hired_at ? formatDate($this->pivot->hired_at) : null,
        ];
    }
}
