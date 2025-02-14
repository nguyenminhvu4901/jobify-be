<?php

namespace App\Enums;
enum DefaultContentType: int
{
    case IMAGE = 1;
    case FILE = 2;
    case URL = 3;
    case VIDEO = 4;

    /**
     * @return DefaultContentType[]
     */
    public static function get(): array
    {
        return [
            'IMAGE' => DefaultContentType::IMAGE,
            'FILE' => DefaultContentType::FILE,
            'URL' => DefaultContentType::URL,
            'VIDEO' => DefaultContentType::VIDEO
        ];
    }
}
