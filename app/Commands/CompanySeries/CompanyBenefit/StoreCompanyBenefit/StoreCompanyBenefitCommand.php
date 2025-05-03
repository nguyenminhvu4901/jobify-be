<?php

namespace App\Commands\CompanySeries\CompanyBenefit\StoreCompanyBenefit;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class StoreCompanyBenefitCommand implements CommandInterface
{
    /**
     * @param string|int $companyId
     * @param string $benefitName
     * @param string $benefitDescription
     */
    public function __construct(
        public string|int $companyId,
        public string $benefitName,
        public string $benefitDescription
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
            benefitName: $request->input('benefit_name'),
            benefitDescription: $request->input('benefit_description')
        );
    }
}
