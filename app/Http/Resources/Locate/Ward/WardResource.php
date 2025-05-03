<?php

namespace App\Http\Resources\Locate\Ward;

use App\Http\Resources\Locate\District\DistrictResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WardResource extends JsonResource
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
            'code' => $this->code,
            'ward_name' => $this->ward_name,
            'district' => DistrictResource::make($this?->district),
        ];
    }
}
