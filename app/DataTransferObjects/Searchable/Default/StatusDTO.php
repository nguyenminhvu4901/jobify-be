<?php

namespace App\DataTransferObjects\Searchable\Default;

readonly class StatusDTO
{
    /**
     * @param $status
     * @return array
     */
    public static function formatStatus($status): array
    {
        return [
            'id' => $status->id,
            'status' => $status->status
        ];
    }
}
