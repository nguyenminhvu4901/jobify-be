<?php

namespace App\Http\Resources\JobSeries\Currency;

use App\DataTransferObjects\Searchable\JobSeries\Currencies\CurrencyDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrencyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return CurrencyDTO::formatCurrency($this->resource);
    }
}
