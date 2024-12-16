<?php

namespace App\Http\Resources\UserProfile;

use App\Http\Resources\DefaultStatus\DefaultStatusResource;
use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProfileResource extends JsonResource
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
            'full_name' => $this->full_name,
            'slug' => $this->slug,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'current_user' => $this->current_user,
            'status' => new DefaultStatusResource($this->status),
            'role' => RoleResource::collection($this->roles),
            'profile' => new ProfileResource($this->userProfile)
        ];
    }
}
