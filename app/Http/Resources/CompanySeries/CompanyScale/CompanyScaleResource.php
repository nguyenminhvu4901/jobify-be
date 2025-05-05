<?php

namespace App\Http\Resources\CompanySeries\CompanyScale;

use App\DataTransferObjects\Searchable\CompanySeries\CompanyScales\CompanyScaleDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyScaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return CompanyScaleDTO::formatCompanyScale($this->resource);
    }
}
