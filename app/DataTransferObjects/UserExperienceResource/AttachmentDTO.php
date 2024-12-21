<?php

namespace App\DataTransferObjects\UserExperienceResource;

use Illuminate\Http\UploadedFile;

class AttachmentDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly int $contentTypeId,
        public readonly ?UploadedFile $content,
        public readonly int|null $userExperienceResourceId = null
    ) {}
}
