<?php

namespace App\Http\Resources\Profile\UserProject;

use App\Http\Resources\Auth\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProjectResource extends JsonResource
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
            'user' => new UserResource($this->user),
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
