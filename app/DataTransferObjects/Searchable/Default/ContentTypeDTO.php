<?php

namespace App\DataTransferObjects\Searchable\Default;

readonly class ContentTypeDTO
{
    /**
     * @param $contentType
     * @return array
     */
    public static function formatContentType($contentType): array
    {
        return [
            'id' => $contentType->id,
            'content_type' => $contentType->content_type
        ];
    }
}
