<?php

namespace App\Http\Resources\UserExperience;

use App\Http\Resources\Role\RoleResource;
use App\Traits\Resources\UserResourceTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrentUserExperienceResource extends JsonResource
{
    use UserResourceTrait;
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
                'experiences' => UserExperienceResource::collection($this->userExperiences)
            ]
        );
    }
}
