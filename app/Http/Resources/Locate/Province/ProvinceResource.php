<?php

namespace App\Http\Resources\Locate\Province;

use App\DataTransferObjects\Searchable\Location\LocationDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return LocationDTO::formatProvince($this->resource);
    }
}
