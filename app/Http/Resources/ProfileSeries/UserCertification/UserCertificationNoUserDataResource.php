<?php

namespace App\Http\Resources\ProfileSeries\UserCertification;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCertificationNoUserDataResource extends JsonResource
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
