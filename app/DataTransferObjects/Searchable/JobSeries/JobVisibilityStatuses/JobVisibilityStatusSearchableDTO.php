<?php

namespace App\DataTransferObjects\Searchable\JobSeries\JobVisibilityStatuses;

readonly class JobVisibilityStatusSearchableDTO
{
    /**
     * @param $status
     * @return array
     */
    public static function formatVisibilityStatus($status): array
    {
        return [
            'id' => $status->id,
            'name' => $status->name
        ];
    }
}
