<?php

namespace App\Http\Resources\CompanySeries\BusinessSector;

use App\DataTransferObjects\Searchable\CompanySeries\BusinessSectors\BusinessSectorDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessSectorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return BusinessSectorDTO::formatBusinessSector($this->resource);
    }
}
