<?php

namespace App\Enums;

enum Status: int
{
    case DEACTIVATE = 2;
    case ACTIVE = 1;

    public static function get(): array {
        return [
            'DEACTIVATE' => Status::DEACTIVATE,
            'ACTIVE' => Status::ACTIVE,
        ];
    }
}
