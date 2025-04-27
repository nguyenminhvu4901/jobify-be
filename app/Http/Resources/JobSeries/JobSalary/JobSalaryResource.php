<?php

namespace App\Http\Resources\JobSeries\JobSalary;

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
        return [
            'id' => $this->id,
            'job_listing_id' => $this->job_listing_id,
            'currency' => CurrencyResource::make($this->currency),
            'job_salary_type' => JobSalaryTypeResource::make($this->jobSalaryType),
            'from' => $this->from,
            'to' => $this->to
        ];
    }
}
