<?php

namespace App\Http\Resources\Locate\Ward;

use App\DataTransferObjects\Searchable\Location\LocationDTO;
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
            ...LocationDTO::formatWard($this->resource),
            'district' => DistrictResource::make($this?->district)
        ];
    }
}
