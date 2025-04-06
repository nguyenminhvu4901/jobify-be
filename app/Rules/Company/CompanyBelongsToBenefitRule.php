<?php

namespace App\Rules\Company;

use App\Entities\CompanySeries\Company\Company;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CompanyBelongsToBenefitRule implements ValidationRule
{
    public function __construct(
        protected string|int $companyBenefitId
    )
    {
    }

    /**
     * Run the validation rule.
     *
     * @param Closure(string, ?string=): PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $checkExists = Company::where('id', $value)
            ->whereCompanyBenefitId($this->companyBenefitId)
            ->doesntExist();

        if($checkExists){
            $fail(__('validation.custom.company_id_benefit_id_mismatch'));
        }
    }
}
