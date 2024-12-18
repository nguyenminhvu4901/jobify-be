<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\DefaultStatus\DefaultStatusResource;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\UserProfile\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrentUserInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'token' => $request->bearerToken(),
            'id' => $this->id,
            'full_name' => $this->full_name,
            'slug' => $this->slug,
            'email' => $this->email,
            'current_role' => $this->current_role,
            'status' => new DefaultStatusResource($this->status),
            'avatar' => $this->avatar,
            'role' => RoleResource::collection($this->roles),
            'profile' => new ProfileResource($this->userProfile)
        ];
    }
}
