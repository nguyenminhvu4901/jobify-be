<?php

namespace App\Enums;

enum StatusEnum: int
{
    case ACTIVE = 1;

    case DEACTIVATE = 2;

    /**
     * @return StatusEnum[]
     */
    public static function get(): array
    {
        return [
            'DEACTIVATE' => StatusEnum::DEACTIVATE,
            'ACTIVE' => StatusEnum::ACTIVE,
        ];
    }
}
