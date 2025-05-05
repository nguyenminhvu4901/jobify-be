<?php

namespace App\DataTransferObjects\Searchable\Default;

readonly class GenderDTO
{
    /**
     * @param $gender
     * @return array
     */
    public static function formatGender($gender): array
    {
        return [
            'id' => $gender->id,
            'gender' => $gender->gender
        ];
    }
}
