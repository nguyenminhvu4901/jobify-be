<?php

namespace App\Http\Requests\JobSeries\Position;

use App\Enums\RouteNames\JobSeries\PositionEnum;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class JobPositionRequest extends FormRequest
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

        return match ($routeName) {
            PositionEnum::PREFIX->value.PositionEnum::LIST_SECONDARY_POSITION->value => [
                ...$this->getCommonRules(),
            ],
            default => [],
        };
    }

    private function getCommonRules(): array
    {
        return [
            'main_position_id' => ['bail', 'required', 'integer', 'exists:positions,id'],
        ];
    }
}
