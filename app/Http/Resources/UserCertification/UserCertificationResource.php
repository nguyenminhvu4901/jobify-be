<?php

namespace App\Http\Resources\UserCertification;

use App\Http\Resources\Auth\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCertificationResource extends JsonResource
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
            'organization' => $this->organization,
            'is_no_expiration' => getStatus($this->is_no_expiration),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'user_certification_resource' => UserCertificationAttachmentResource::collection(
                $this->userCertificationResources
            ),
        ];
    }
}
