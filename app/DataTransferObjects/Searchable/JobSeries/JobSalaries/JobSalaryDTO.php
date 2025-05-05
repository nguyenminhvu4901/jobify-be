<?php

namespace App\DataTransferObjects\Searchable\JobSeries\JobSalaries;

use App\Http\Resources\JobSeries\Currency\CurrencyResource;
use App\Http\Resources\JobSeries\JobSalaryTypes\JobSalaryTypeResource;

readonly class JobSalaryDTO
{
    /**
     * @param $jobSalary
     * @return array
     */
    public static function formatJobSalary($jobSalary): array
    {
        return [
            'id' => $jobSalary->id,
            'job_listing_id' => $jobSalary->job_listing_id,
            'currency' => CurrencyResource::make($jobSalary->currency),
            'job_salary_type' => JobSalaryTypeResource::make($jobSalary->jobSalaryType),
            'from' => $jobSalary->from,
            'to' => $jobSalary->to
        ];
    }
}
