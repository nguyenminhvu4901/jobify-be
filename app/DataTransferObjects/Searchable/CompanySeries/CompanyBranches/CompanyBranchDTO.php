<?php

namespace App\DataTransferObjects\Searchable\CompanySeries\CompanyBranches;

use App\Http\Resources\Locate\District\DistrictResource;
use App\Http\Resources\Locate\Province\ProvinceResource;
use App\Http\Resources\Locate\Ward\WardResource;

readonly class CompanyBranchDTO
{
    /**
     * @param $companyBranch
     * @return array
     */
    public static function formatCompanyBranch($companyBranch): array
    {
        return [
            'id' => $companyBranch->id,
            'company_id' => $companyBranch->company_id,
            'branch_name' => $companyBranch->branch_name,
            'province' => ProvinceResource::make($companyBranch->province),
            'district' => DistrictResource::make($companyBranch->district),
            'ward' => WardResource::make($companyBranch->ward),
            'address' => $companyBranch->address
        ];
    }
}
