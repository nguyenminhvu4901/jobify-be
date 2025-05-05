<?php

namespace App\Http\Resources\JobSeries\JobLevel;

use App\DataTransferObjects\Searchable\JobSeries\JobLevels\JobLevelDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobLevelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return JobLevelDTO::formatJobLevel($this->resource);
    }
}
