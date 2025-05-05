<?php

namespace App\Http\Resources\JobSeries\JobSalary;

use App\DataTransferObjects\Searchable\JobSeries\JobSalaries\JobSalaryDTO;
use App\Http\Resources\JobSeries\Currency\CurrencyResource;
use App\Http\Resources\JobSeries\JobSalaryTypes\JobSalaryTypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobSalaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return JobSalaryDTO::formatJobSalary($this->resource);
    }
}
