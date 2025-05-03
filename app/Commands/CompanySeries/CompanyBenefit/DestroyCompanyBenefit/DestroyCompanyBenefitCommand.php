<?php

namespace App\Commands\CompanySeries\CompanyBenefit\DestroyCompanyBenefit;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyCompanyBenefitCommand implements CommandInterface
{
    public function __construct(
        public string|int $companyId,
        public string|int $companyBenefitId
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            companyId: $request->input('company_id'),
            companyBenefitId: $request->input('company_benefit_id')
        );
    }
}
