<?php

namespace App\Http\Resources\ProfileSeries\UserPrize;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserPrizeNoUserDataResource extends JsonResource
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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'user_prize_resource' => UserPrizeAttachmentResource::collection($this->userPrizeResources),
        ];
    }
}
