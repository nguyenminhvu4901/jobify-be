<?php

namespace App\DataTransferObjects\Searchable\JobSeries\JobTypes;

readonly class JobTypeDTO
{
    /**
     * @param $jobType
     * @return array
     */
    public static function formatJobType($jobType): array
    {
        return [
            'id' => $jobType->id,
            'type' => $jobType->type
        ];
    }
}
