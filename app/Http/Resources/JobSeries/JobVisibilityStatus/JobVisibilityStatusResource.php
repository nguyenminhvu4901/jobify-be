<?php

namespace App\Http\Resources\JobSeries\JobVisibilityStatus;

use App\DataTransferObjects\Searchable\JobSeries\JobVisibilityStatuses\JobVisibilityStatusSearchableDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobVisibilityStatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return JobVisibilityStatusSearchableDTO::formatVisibilityStatus($this->resource);
    }
}
