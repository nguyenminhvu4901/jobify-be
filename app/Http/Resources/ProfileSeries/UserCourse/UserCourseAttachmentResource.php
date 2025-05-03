<?php

namespace App\Http\Resources\ProfileSeries\UserCourse;

use App\Http\Resources\DefaultSeries\DefaultContentType\DefaultContentTypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCourseAttachmentResource extends JsonResource
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
            'user_course_id' => $this->user_course_id,
            'title' => $this->title,
            'path' => $this->path,
            'description' => $this->description,
            'content_type' => new DefaultContentTypeResource($this->contentType)
        ];
    }
}
