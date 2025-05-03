<?php

namespace App\DataTransferObjects\UserExperienceResource;

use Illuminate\Http\UploadedFile;

readonly class AttachmentDTO
{
    /**
     * @param string $title
     * @param string $description
     * @param int $contentTypeId
     * @param UploadedFile|string|null $content
     * @param int|null $userResourceId
     */
    public function __construct(
        public string                   $title,
        public string                   $description,
        public int                      $contentTypeId,
        public UploadedFile|string|null $content,
        public int|null                 $userResourceId = null
    ) {}
}
