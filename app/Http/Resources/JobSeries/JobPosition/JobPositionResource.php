<?php

namespace App\Http\Resources\JobSeries\JobPosition;

use App\DataTransferObjects\Searchable\JobSeries\JobPositions\JobPositionDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobPositionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return JobPositionDTO::formatJobPosition($this->resource);
    }
}
