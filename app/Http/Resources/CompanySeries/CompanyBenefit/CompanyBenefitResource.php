<?php

namespace App\Http\Resources\CompanySeries\CompanyBenefit;

use App\DataTransferObjects\Searchable\CompanySeries\CompanyBenefits\CompanyBenefitDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyBenefitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return CompanyBenefitDTO::formatCompanyBenefit($this->resource);
    }
}
