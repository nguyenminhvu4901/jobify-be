<?php

namespace App\DataTransferObjects\Searchable\JobSeries\JobEducationLevels;

readonly class JobEducationLevelDTO
{
    /**
     * @param $educationLevel
     * @return array
     */
    public static function formatEducationLevel($educationLevel): array
    {
        return [
            'id' => $educationLevel->id,
            'name' => $educationLevel->name,
        ];
    }
}
