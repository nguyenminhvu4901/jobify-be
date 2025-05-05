<?php

namespace App\DataTransferObjects\Searchable\JobSeries\JobExperiences;

readonly class JobExperienceDTO
{
    /**
     * @param $experience
     * @return array
     */
    public static function formatExperience($experience): array
    {
        return [
            'id' => $experience->id,
            'name' => $experience->name,
        ];
    }
}
