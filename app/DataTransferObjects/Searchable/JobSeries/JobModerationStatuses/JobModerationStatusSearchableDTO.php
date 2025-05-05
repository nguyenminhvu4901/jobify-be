<?php

namespace App\DataTransferObjects\Searchable\JobSeries\JobModerationStatuses;

readonly class JobModerationStatusSearchableDTO
{
    /**
     * @param $status
     * @return array
     */
    public static function formatModerationStatus($status): array
    {
        return [
            'id' => $status->id,
            'name' => $status->name,
            'pivot' => $status->pivot?->toArray(),
        ];
    }
}
