<?php

namespace App\Http\Resources\Profile\UserLocation;

use App\Http\Resources\Auth\UserResource;
use App\Http\Resources\Locate\District\DistrictResource;
use App\Http\Resources\Locate\Province\ProvinceResource;
use App\Http\Resources\Locate\Ward\WardResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this?->id,
            'user' => new UserResource($this->user),
            'province' => ProvinceResource::make($this->province),
            'district' => DistrictResource::make($this->district),
            'ward' => WardResource::make($this->ward),
            'address' => $this->address
        ];
    }
}
