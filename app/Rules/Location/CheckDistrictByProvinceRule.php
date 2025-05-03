<?php

namespace App\Rules\Location;

use App\Entities\Locate\District\District;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

readonly class CheckDistrictByProvinceRule implements ValidationRule
{
    public function __construct(
        protected string|int|null $provinceId
    ) {
    }

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $checkDistrict = District::where('id', $value)
            ->whereProvinceId($this->provinceId)
            ->doesntExist();

        if ($checkDistrict) {
            $fail(__('validation.custom.invalid_district_in_province'));
        }
    }
}
