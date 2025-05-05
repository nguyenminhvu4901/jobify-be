<?php

namespace App\DataTransferObjects\Searchable\JobSeries\JobAgeRanges;

readonly class JobAgeRangeDTO
{
    /**
     * @param $jobAgeRange
     * @return array
     */
    public static function formatJobAgeRange($jobAgeRange): array
    {
        return [
            'id' => $jobAgeRange->id,
            'min_age' => $jobAgeRange->min_age,
            'max_age' => $jobAgeRange->max_age
        ];
    }
}
