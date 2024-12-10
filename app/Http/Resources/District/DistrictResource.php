<?php

namespace App\Http\Resources\District;

use App\Http\Resources\Province\ProvinceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DistrictResource extends JsonResource
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
            'province' => new ProvinceResource($this->province),
            'code' => $this->code,
            'district_name' => $this->district_name
        ];
    }
}
