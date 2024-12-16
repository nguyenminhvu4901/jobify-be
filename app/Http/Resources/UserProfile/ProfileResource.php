<?php

namespace App\Http\Resources\UserProfile;

use App\Http\Resources\DefaultGender\DefaultGenderResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'position' => $this->position,
            'gender' => new DefaultGenderResource($this->gender),
            'birth_date' => $this->birth_date,
            'description' => $this->description,
            'avatar' => $this->avatar
        ];
    }
}
