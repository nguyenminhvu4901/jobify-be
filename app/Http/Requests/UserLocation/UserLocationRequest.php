<?php

namespace App\Http\Requests\UserLocation;

use App\Enums\RouteNames\Profile\UserLocation;
use App\Rules\Location\CheckDistrictByProvinceRule;
use App\Rules\Location\CheckWardByDistrictRule;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserLocationRequest extends FormRequest
{
    use FailedValidation;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $routeName = request()->route()->getName();

        $commonRules = $this->getCommonRules();

        return match ($routeName){
            "profile.userLocation." . UserLocation::STORE->value => $commonRules,
            'profile.userLocation.' . UserLocation::UPDATE->value => [
                ...$commonRules,
                'user_location_id' => ['bail', 'required', 'integer', 'exists:user_locations,id'],
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
            'profile.userLocation.' . UserLocation::DESTROY->value => [
                'user_location_id' => ['bail', 'required', 'integer', 'exists:user_locations,id'],
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
            "profile.userLocation." . UserLocation::DETAIL_LIST_USER_LOCATION->value => [
                'user_location_id' => ['bail', 'required', 'integer', 'exists:user_locations,id'],
            ],
            "profile.userLocation." . UserLocation::DETAIL_LIST_USER_LOCATION_BY_USER_SLUG->value => [
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
            default => []
        };
    }

    private function getCommonRules(): array
    {
        return [
            'province_id' => ['bail', 'nullable', 'integer', 'exists:provinces,id'],
            'district_id' => [
                'bail', 'nullable', 'integer', 'exists:districts,id',
                new CheckDistrictByProvinceRule()
                ],
            'ward_id' => [
                'bail', 'nullable', 'integer', 'exists:wards,id',
                new CheckWardByDistrictRule()
            ],
            'address' => ['bail', 'nullable', 'string', 'max:512']
        ];
    }
}
