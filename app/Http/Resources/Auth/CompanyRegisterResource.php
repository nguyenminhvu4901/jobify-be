<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\CompanySeries\CompanyScale\CompanyScaleResource;
use App\Http\Resources\DefaultSeries\DefaultGender\DefaultGenderResource;
use App\Http\Resources\DefaultSeries\DefaultStatus\DefaultStatusResource;
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
            'company_status' => DefaultStatusResource::make($this?->status),
            'gender' => new DefaultGenderResource($this->gender),
            'tax_code' => $this->tax_code,
            'branches' => CompanyBranchResource::collection($this->companyBranches),
            'avatar' => $this->avatar
        ];
    }
}
