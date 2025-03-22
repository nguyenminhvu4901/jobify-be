<?php

namespace App\Http\Resources\ProfileSeries\UserCourse;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCourseNoUserDataResource extends JsonResource
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
            'name' => $this->name,
            'organization' => $this->organization,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'user_course_resource' => UserCourseAttachmentResource::collection(
                $this->userCourseResources
            ),
        ];
    }
}
