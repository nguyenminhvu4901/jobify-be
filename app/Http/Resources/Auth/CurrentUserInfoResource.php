<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\Profile\UserProfile\ProfileResource;
use App\Http\Resources\Role\RoleResource;
use App\Traits\Resources\UserResourceTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrentUserInfoResource extends JsonResource
{
    use UserResourceTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...$this->userData(),
            'token' => $request->bearerToken(),
            'role' => RoleResource::collection($this->roles),
            'profile' => new ProfileResource($this->userProfile)
        ];
    }
}
