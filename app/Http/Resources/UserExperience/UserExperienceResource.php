<?php

namespace App\Http\Resources\UserExperience;

use App\Http\Resources\Auth\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserExperienceResource extends JsonResource
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
            'position' => $this->position,
            'is_working' => getStatus($this->is_working),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date
        ];
    }
}
