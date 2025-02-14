<?php

namespace App\Http\Resources\UserSkill;

use App\Http\Resources\Auth\UserResource;
use App\Http\Resources\DefaultRate\DefaultRateResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserSkillNoUserDataResource extends JsonResource
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
            'rate' => new DefaultRateResource($this->rate),
            'description' => $this->description,
            'created_at' => formatDateTime($this->created_at),
            'updated_at' => formatDateTime($this->updated_at)
        ];
    }
}
