<?php

namespace App\Commands\CompanySeries\CompanyBenefit\GetListCompanyBenefit;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetListCompanyBenefitCommand implements CommandInterface
{
    public function __construct(
        public string|int $companyId
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            companyId: $request->input('company_id')
        );
    }
}
