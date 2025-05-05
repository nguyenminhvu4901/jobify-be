<?php

namespace App\Http\Resources\Locate\District;

use App\DataTransferObjects\Searchable\Location\LocationDTO;
use App\Http\Resources\Locate\Province\ProvinceResource;
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
            ...LocationDTO::formatDistrict($this->resource),
            'province' => new ProvinceResource($this->province),
        ];
    }
}
