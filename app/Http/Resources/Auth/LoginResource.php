<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\DefaultStatus\DefaultStatusResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'token' => $this->token,
            'user' => [
                'id' => $this->id,
                'full_name' => $this->full_name,
                'email' => $this->email,
                'status' => new DefaultStatusResource($this->status),
//                'roles' => RoleResource::collection($this->roles),
//                'permissions' => PermissionResource::collection($this->permissions),
            ],
        ];
    }
}
