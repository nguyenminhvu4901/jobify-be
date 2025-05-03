<?php

namespace App\Commands\CompanySeries\CompanyBenefit\UpdateCompanyBenefit;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class UpdateCompanyBenefitCommand implements CommandInterface
{
    public function __construct(
        public string|int $companyId,
        public string|int $companyBenefitId,
        public string $benefitName,
        public string $benefitDescription
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            companyId: $request->input('company_id'),
            companyBenefitId: $request->input('company_benefit_id'),
            benefitName: $request->input('benefit_name'),
            benefitDescription: $request->input('benefit_description')
        );
    }
}
