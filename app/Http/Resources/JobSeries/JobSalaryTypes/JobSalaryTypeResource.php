<?php

namespace App\Http\Resources\JobSeries\JobSalaryTypes;

use App\DataTransferObjects\Searchable\JobSeries\JobSalaryTypes\JobSalaryTypeDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobSalaryTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return JobSalaryTypeDTO::formatJobSalaryType($this->resource);
    }
}
