<?php

namespace App\Commands\CompanySeries\CompanyBenefit\DestroyCompanyBenefit;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyCompanyBenefitCommand implements CommandInterface
{
    /**
     * @param string|int $companyId
     * @param string|int $companyBenefitId
     */
    public function __construct(
        public string|int $companyId,
        public string|int $companyBenefitId
    )
    {
    }

    /**
     * @param FormRequest $request
     * @return CommandInterface
     */
    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            companyId: $request->input('company_id'),
            companyBenefitId: $request->input('company_benefit_id')
        );
    }
}
