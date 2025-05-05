<?php

namespace App\Http\Resources\JobSeries\JobAgeRanges;

use App\DataTransferObjects\Searchable\JobSeries\JobAgeRanges\JobAgeRangeDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobAgeRangeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return JobAgeRangeDTO::formatJobAgeRange($this->resource);
    }
}
