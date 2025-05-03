<?php

namespace App\Http\Resources\CompanySeries\CompanyProfile;

use App\Http\Resources\CompanySeries\BusinessSector\BusinessSectorResource;
use App\Http\Resources\CompanySeries\CompanyBenefit\CompanyBenefitResource;
use App\Http\Resources\CompanySeries\CompanyBranch\CompanyBranchResource;
use App\Http\Resources\CompanySeries\CompanyScale\CompanyScaleResource;
use App\Http\Resources\CompanySeries\CompanyWorkingDay\CompanyWorkingDayResource;
use App\Http\Resources\CompanySeries\OperationType\OperationTypeResource;
use App\Http\Resources\DefaultSeries\DefaultGender\DefaultGenderResource;
use App\Http\Resources\DefaultSeries\DefaultStatus\DefaultStatusResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyProfileResource extends JsonResource
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
            'user_id' => $this->user_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'tax_code' => $this->tax_code,
            'company_scale' => CompanyScaleResource::make($this?->companyScale),
            'gender' => DefaultGenderResource::make($this?->gender),
            'company_status' => DefaultStatusResource::make($this?->status),
            'company_working_day' => CompanyWorkingDayResource::make($this?->companyWorkingDay),
            'website' => $this?->website,
            'description' => $this->description,
            'avatar' => $this->avatar,
            'company_branches' => CompanyBranchResource::collection($this?->companyBranches),
            'operation_types' => OperationTypeResource::collection($this?->operationTypes),
            'business_sectors' => BusinessSectorResource::collection($this?->businessSectors),
            'company_benefits' => CompanyBenefitResource::collection($this?->companyBenefits),
        ];
    }
}
