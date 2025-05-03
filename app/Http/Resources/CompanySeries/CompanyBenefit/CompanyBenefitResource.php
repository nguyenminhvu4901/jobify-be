<?php

namespace App\Http\Resources\CompanySeries\CompanyBenefit;

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
        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'benefit_name' => $this->benefit_name,
            'description' => $this->description,
        ];
    }
}
