<?php

namespace App\Rules\Location;

use App\Entities\Ward\Ward;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CheckWardByDistrictRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $districtId = request('district_id');

        $checkWard = Ward::where('id', $value)->where('district_id', $districtId)->exists();

        if(!$checkWard){
            $fail(__('validation.custom.invalid_ward_in_district'));
        }
    }
}
