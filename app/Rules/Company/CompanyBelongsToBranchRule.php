<?php

namespace App\Rules\Company;

use App\Entities\CompanySeries\Company\Company;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

readonly class CompanyBelongsToBranchRule implements ValidationRule
{
    public function __construct(
        protected string|int $companyBranchId
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
            ->whereCompanyBranchId($this->companyBranchId)
            ->doesntExist();

        if($checkExists){
            $fail(__('validation.custom.company_id_branch_id_mismatch'));
        }
    }
}
