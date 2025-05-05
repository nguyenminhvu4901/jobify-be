<?php

namespace App\DataTransferObjects\Searchable\JobSeries\JobSalaries;

use App\DataTransferObjects\Searchable\JobSeries\Currencies\CurrencyDTO;
use App\DataTransferObjects\Searchable\JobSeries\JobSalaryTypes\JobSalaryTypeDTO;

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
            'currency' => optional($jobSalary->currency,
                fn($currency) => CurrencyDTO::formatCurrency($currency)),
            'job_salary_type' => optional($jobSalary->jobSalaryType,
                fn($jobSalaryType) => JobSalaryTypeDTO::formatJobSalaryType($jobSalaryType)),
            'from' => $jobSalary->from,
            'to' => $jobSalary->to
        ];
    }
}
