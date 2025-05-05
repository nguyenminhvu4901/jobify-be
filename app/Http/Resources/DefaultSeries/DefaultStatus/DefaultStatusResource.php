<?php

namespace App\Http\Resources\DefaultSeries\DefaultStatus;

use App\DataTransferObjects\Searchable\Default\StatusDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DefaultStatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return StatusDTO::formatStatus($this->resource);
    }
}
