<?php

namespace App\DataTransferObjects\Searchable\CompanySeries\CompanyBenefits;

readonly class CompanyBenefitDTO
{
    /**
     * @param $companyBenefit
     * @return array
     */
    public static function formatCompanyBenefit($companyBenefit): array
    {
        return [
            'id' => $companyBenefit->id,
            'company_id' => $companyBenefit->company_id,
            'benefit_name' => $companyBenefit->benefit_name,
            'description' => $companyBenefit->description
        ];
    }
}
