<?php

namespace App\Http\Resources\JobSeries\JobExperience;

use App\DataTransferObjects\Searchable\JobSeries\JobExperiences\JobExperienceDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobExperienceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return JobExperienceDTO::formatExperience($this->resource);
    }
}
