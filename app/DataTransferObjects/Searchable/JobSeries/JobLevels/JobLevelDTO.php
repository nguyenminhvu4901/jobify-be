<?php

namespace App\DataTransferObjects\Searchable\JobSeries\JobLevels;

readonly class JobLevelDTO
{
    /**
     * @param $jobLevel
     * @return array
     */
    public static function formatJobLevel($jobLevel): array
    {
        return [
            'id' => $jobLevel->id,
            'title' => $jobLevel->title,
            'description' => $jobLevel->description
        ];
    }
}
