<?php

namespace App\Http\Resources\ProfileSeries\UserProject;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProjectNoUserDataResource extends JsonResource
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
            'user_id' => $this->user_id,
            'name' => $this->name,
            'client' => $this->client,
            'member' => $this->member,
            'position' => $this->position,
            'mission' => $this->mission,
            'technology' => $this->technology,
            'is_working' => getStatus($this->is_working),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->description,
            'user_project_resource' => UserProjectAttachmentResource::collection($this->userProjectResources)
        ];
    }
}
