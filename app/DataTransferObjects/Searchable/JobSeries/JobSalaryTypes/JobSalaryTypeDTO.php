<?php

namespace App\DataTransferObjects\Searchable\JobSeries\JobSalaryTypes;

readonly class JobSalaryTypeDTO
{
    /**
     * @param $jobSalaryType
     * @return array
     */
    public static function formatJobSalaryType($jobSalaryType): array
    {
        return [
            'id' => $jobSalaryType->id,
            'type' => $jobSalaryType->type
        ];
    }
}
