<?php

namespace App\DataTransferObjects\Searchable\CompanySeries\Companies;

use App\DataTransferObjects\Searchable\CompanySeries\BusinessSectors\BusinessSectorDTO;
use App\DataTransferObjects\Searchable\CompanySeries\CompanyBenefits\CompanyBenefitDTO;
use App\DataTransferObjects\Searchable\CompanySeries\CompanyBranches\CompanyBranchDTO;
use App\DataTransferObjects\Searchable\CompanySeries\CompanyScales\CompanyScaleDTO;
use App\DataTransferObjects\Searchable\CompanySeries\CompanyWorkingDays\CompanyWorkingDayDTO;
use App\DataTransferObjects\Searchable\CompanySeries\OperationTypes\OperationTypeDTO;
use App\DataTransferObjects\Searchable\Default\GenderDTO;
use App\DataTransferObjects\Searchable\Default\StatusDTO;

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

            'company_scale' => optional($company->companyScale, fn($scale) => CompanyScaleDTO::formatCompanyScale($scale)),

            'gender' => optional($company->gender, fn($g) => GenderDTO::formatGender($g)),

            'company_status' => optional($company->status, fn($status) => StatusDTO::formatStatus($status)),

            'company_working_day' => optional($company->companyWorkingDay,
                fn($companyWorkingDay) => CompanyWorkingDayDTO::formatCompanyWorkingDay($companyWorkingDay)),

            'website' => $company?->website,
            'description' => $company->description,
            'avatar' => $company->avatar,

            'company_branches' => $company->companyBranches->map(
                fn($branch) => CompanyBranchDTO::formatCompanyBranch($branch))
                ?->values()->toArray(),

            'operation_types' => $company->operationTypes->map(
                fn($operationType) => OperationTypeDTO::formatOperationType($operationType))
                ?->values()->toArray(),

            'business_sectors' => $company->businessSectors->map(
                fn($businessSector) => BusinessSectorDTO::formatBusinessSector($businessSector))
                ?->values()->toArray(),

            'company_benefits' => $company->companyBenefits->map(
                fn($companyBenefit) => CompanyBenefitDTO::formatCompanyBenefit($companyBenefit))
                ?->values()->toArray(),
        ];
    }
}
