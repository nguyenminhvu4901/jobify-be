<?php

namespace App\Http\Resources\ProfileSeries\UserPrize;

use App\Http\Resources\Role\RoleResource;
use App\Traits\Resources\UserResourceTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrentUserPrizeResource extends JsonResource
{
    use UserResourceTrait;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...$this->userData(),
            'roles' => RoleResource::collection($this->roles),
            'prizes' => UserPrizeNoUserDataResource::collection($this->userPrizes),
        ];
    }
}
