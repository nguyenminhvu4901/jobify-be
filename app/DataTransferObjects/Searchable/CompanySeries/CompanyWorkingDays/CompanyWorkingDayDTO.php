<?php

namespace App\DataTransferObjects\Searchable\CompanySeries\CompanyWorkingDays;

readonly class CompanyWorkingDayDTO
{
    /**
     * @param $companyWorkingDay
     * @return array
     */
    public static function formatCompanyWorkingDay($companyWorkingDay): array
    {
        return [
            'id' => $companyWorkingDay->id,
            'working_day' => $companyWorkingDay->working_day
        ];
    }
}
