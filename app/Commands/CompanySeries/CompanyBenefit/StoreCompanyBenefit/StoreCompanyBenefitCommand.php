<?php

namespace App\Commands\CompanySeries\CompanyBenefit\StoreCompanyBenefit;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class StoreCompanyBenefitCommand implements CommandInterface
{
    public function __construct(
        public string|int $companyId,
        public string $benefitName,
        public string $benefitDescription
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            companyId: $request->input('company_id'),
            benefitName: $request->input('benefit_name'),
            benefitDescription: $request->input('benefit_description')
        );
    }
}
