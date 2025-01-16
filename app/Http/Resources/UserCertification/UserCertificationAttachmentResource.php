<?php

namespace App\Http\Resources\UserCertification;

use App\Http\Resources\DefaultContentType\DefaultContentTypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCertificationAttachmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_experience_id' => $this->user_experience_id,
            'title' => $this->title,
            'path' => $this->path,
            'description' => $this->description,
            'content_type' => new DefaultContentTypeResource($this->contentType)
        ];
    }
}
