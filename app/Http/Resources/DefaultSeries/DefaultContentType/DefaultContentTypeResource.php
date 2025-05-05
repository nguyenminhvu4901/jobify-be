<?php

namespace App\Http\Resources\DefaultSeries\DefaultContentType;

use App\DataTransferObjects\Searchable\Default\ContentTypeDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DefaultContentTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return ContentTypeDTO::formatContentType($this->resource);
    }
}
