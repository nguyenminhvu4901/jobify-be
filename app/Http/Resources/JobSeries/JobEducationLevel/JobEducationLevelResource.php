<?php

namespace App\Http\Resources\JobSeries\JobEducationLevel;

use App\DataTransferObjects\Searchable\JobSeries\JobEducationLevels\JobEducationLevelDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobEducationLevelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return JobEducationLevelDTO::formatEducationLevel($this->resource);
    }
}
