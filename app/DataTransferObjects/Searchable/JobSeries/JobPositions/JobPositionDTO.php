<?php

namespace App\DataTransferObjects\Searchable\JobSeries\JobPositions;

readonly class JobPositionDTO
{
    /**
     * @param $position
     * @return array
     */
    public static function formatJobPosition($position): array
    {
        return [
            'id' => $position->id,
            'name' => $position->name,
            'priority' => optional($position->pivot)->priority,
        ];
    }
}
