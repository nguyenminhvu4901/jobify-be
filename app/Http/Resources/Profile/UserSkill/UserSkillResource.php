<?php

namespace App\Http\Resources\Profile\UserSkill;

use App\Http\Resources\Auth\UserResource;
use App\Http\Resources\Default\DefaultRate\DefaultRateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSkillResource extends JsonResource
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
            'rate' => new DefaultRateResource($this->rate),
            'description' => $this->description,
            'created_at' => formatDateTime($this->created_at),
            'updated_at' => formatDateTime($this->updated_at)
        ];
    }
}
