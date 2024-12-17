<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\DefaultStatus\DefaultStatusResource;
use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobSeekerRegisterResource extends JsonResource
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
            'current_role' => $this->current_role,
            'status' => new DefaultStatusResource($this->status),
            'avatar' => $this->avatar,
            'role' => RoleResource::collection($this->roles)
        ];
    }
}
