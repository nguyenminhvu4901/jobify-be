<?php

namespace App\Http\Resources\Profile\UserEducation;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserEducationNoUserDataResource extends JsonResource
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
            'major' => $this->major,
            'is_studying' => getStatus($this->is_studying),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->description
        ];
    }
}
