<?php

namespace App\DataTransferObjects\Searchable\CompanySeries\BusinessSectors;

readonly class BusinessSectorDTO
{
    /**
     * @param $businessSector
     * @return array
     */
    public static function formatBusinessSector($businessSector): array
    {
        return [
            'id' => $businessSector->id,
            'name' => $businessSector->name,
            'description' => $businessSector->description
        ];
    }
}
