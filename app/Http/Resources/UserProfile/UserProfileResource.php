<?php

namespace App\Http\Resources\UserProfile;

use App\Http\Resources\DefaultStatus\DefaultStatusResource;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\UserExperience\UserExperienceResource;
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
        return array_merge(
            $this->userData(),
            [
                'roles' => RoleResource::collection($this->roles),
                'profile' => new ProfileResource($this->userProfile)
            ]
        );
    }
}
