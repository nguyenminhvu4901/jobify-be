<?php

namespace App\Http\Resources\DefaultSeries\DefaultRate;

use App\DataTransferObjects\Searchable\Default\RateDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DefaultRateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return RateDTO::formatRate($this->resource);
    }
}
