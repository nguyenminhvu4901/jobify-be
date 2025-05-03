<?php

namespace App\Rules\Location;

use App\Entities\Locate\Ward\Ward;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CheckWardByDistrictRule implements ValidationRule
{
    public function __construct(
        protected string|int|null $districtId
    ) {
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $checkWard = Ward::where('id', $value)
            ->whereDistrictId($this->districtId)
            ->doesntExist();

        if (! $checkWard) {
            $fail(__('validation.custom.invalid_ward_in_district'));
        }
    }
}
