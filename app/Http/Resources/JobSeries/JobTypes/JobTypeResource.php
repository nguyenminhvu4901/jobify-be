<?php

namespace App\Http\Resources\JobSeries\JobTypes;

use App\DataTransferObjects\Searchable\JobSeries\JobTypes\JobTypeDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return JobTypeDTO::formatJobType($this->resource);
    }
}
