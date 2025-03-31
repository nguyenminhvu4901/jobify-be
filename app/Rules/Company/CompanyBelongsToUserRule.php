<?php

namespace App\Rules\Company;

use App\Entities\CompanySeries\Company\Company;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

readonly class CompanyBelongsToUserRule implements ValidationRule
{
    public function __construct(
        protected string|int $userId
    )
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $checkExists = Company::whereUserId($this->userId)
            ->where('id', $value)
            ->exists();

        if(!$checkExists){
            $fail(__('validation.custom.company_id_user_id_mismatch'));
        }
    }
}
