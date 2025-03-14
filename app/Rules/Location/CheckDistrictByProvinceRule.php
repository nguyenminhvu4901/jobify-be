<?php

namespace App\Rules\Location;

use App\Entities\District\District;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CheckDistrictByProvinceRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $provinceId = request('province_id');

        $checkDistrict = District::where('id', $value)->where('province_id', $provinceId)->exists();

        if(!$checkDistrict){
            $fail(__('validation.custom.invalid_district_in_province'));
        }
    }
}
