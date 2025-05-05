<?php

namespace App\DataTransferObjects\Searchable\CompanySeries\Companies;

use App\DataTransferObjects\Searchable\Default\GenderDTO;
use App\DataTransferObjects\Searchable\Default\StatusDTO;
use App\DataTransferObjects\Searchable\Location\LocationDTO;

readonly class CompanySearchableDTO
{
    /**
     * @param $company
     * @return array
     */
    public static function formatCompany($company): array
    {
        return [
            'id' => $company->id,
            'user_id' => $company->user_id,
            'name' => $company->name,
            'slug' => $company->slug,
            'tax_code' => $company->tax_code,
            'company_scale' => optional($company->companyScale, fn($scale) => [
                'id' => $scale->id,
                'name' => $scale->name,
                'description' => $scale->description,
                'display' => $scale?->display
            ]),
            'gender' => optional($company->gender, fn($g) => GenderDTO::formatGender($g)),
            'company_status' => optional($company->status, fn($status) => StatusDTO::formatStatus($status)),
            'company_working_day' => optional($company->companyWorkingDay, fn($companyWorkingDay) => [
                'id' => $companyWorkingDay?->id,
                'working_day' => $companyWorkingDay?->working_day
            ]),
            'website' => $company?->website,
            'description' => $company->description,
            'avatar' => $company->avatar,

            'company_branches' => $company->companyBranches->map(fn($branch) => [
                'id' => $branch->id,
                'company_id' => $branch->company_id,
                'branch_name' => $branch->branch_name,
                'province' => LocationDTO::formatProvince($branch->province),
                'district' => LocationDTO::formatDistrict($branch->district),
                'ward' => LocationDTO::formatWard($branch->ward),
                'address' => $branch->address
            ])?->values()->toArray(),

            'operation_types' => $company->operationTypes->map(fn($operationType) => [
                'id' => $operationType->id,
                'name' => $operationType->name,
                'description' => $operationType->description
            ])?->values()->toArray(),

            'business_sectors' => $company->businessSectors->map(fn($businessSector) => [
                'id' => $businessSector->id,
                'name' => $businessSector->name,
                'description' => $businessSector->description
            ])?->values()->toArray(),

            'company_benefits' => $company->companyBenefits->map(fn($companyBenefit) => [
                'id' => $companyBenefit->id,
                'company_id' => $companyBenefit->company_id,
                'benefit_name' => $companyBenefit->benefit_name,
                'description' => $companyBenefit->description
            ])?->values()->toArray(),
        ];
    }
}
