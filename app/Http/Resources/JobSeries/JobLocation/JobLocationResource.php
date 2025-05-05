<?php

namespace App\Http\Resources\JobSeries\JobLocation;

use App\DataTransferObjects\Searchable\JobSeries\JobLocations\JobLocationDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobLocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return JobLocationDTO::formatJobLocation($this->resource);
    }
}
