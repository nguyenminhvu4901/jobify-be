<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\CompanyScale\CompanyScaleResource;
use App\Http\Resources\DefaultGender\DefaultGenderResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyRegisterResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'company_scale' => new CompanyScaleResource($this->companyScale),
            'gender' => new DefaultGenderResource($this->gender),
            'tax_code' => $this->tax_code,
            'address' => new CompanyAddressResource($this->companyAddress)
        ];
    }
}
