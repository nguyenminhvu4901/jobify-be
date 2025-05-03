<?php

namespace App\DataTransferObjects\UserExperienceResource;

use Illuminate\Http\UploadedFile;

readonly class AttachmentDTO
{
    public function __construct(
        public string $title,
        public string $description,
        public int $contentTypeId,
        public UploadedFile|string|null $content,
        public ?int $userResourceId = null
    ) {
    }
}
