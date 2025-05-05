<?php

namespace App\DataTransferObjects\Searchable\CompanySeries\CompanyScales;

readonly class CompanyScaleDTO
{
    public static function formatCompanyScale($companyScale): array
    {
        return [
            'id' => $companyScale->id,
            'name' => $companyScale->name,
            'description' => $companyScale->description,
            'display' => $companyScale?->display
        ];
    }
}
