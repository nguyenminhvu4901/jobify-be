<?php

namespace App\Http\Requests\Profile\UserProduct;

use App\Enums\RouteNames\Profile\UserProductEnum;
use App\Rules\Resource\ExistsInResourceRelation;
use App\Rules\Resource\UniqueArrayValues;
use App\Traits\CustomDate\NormalizeDateTrait;
use App\Traits\CustomValidatorAfter\ValidatesAttachmentsTrait;
use App\Traits\ValidationResponse\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserProductRequest extends FormRequest
{
    use FailedValidation, ValidatesAttachmentsTrait, NormalizeDateTrait;
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

        return match ($routeName) {
            UserProductEnum::PREFIX->value . UserProductEnum::DETAIL_LIST_USER_PRODUCT->value => [
                'user_product_id' => ['bail', 'required', 'integer', 'exists:user_products,id']
            ],
            UserProductEnum::PREFIX->value . UserProductEnum::DETAIL_LIST_USER_PRODUCT_BY_USER_SLUG->value => [
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
            UserProductEnum::PREFIX->value . UserProductEnum::STORE->value => $commonRules,
            UserProductEnum::PREFIX->value. UserProductEnum::UPDATE->value => [
                ...$commonRules,
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
                'user_product_id' => ['bail', 'required', 'integer', 'exists:user_products,id'],
                'attachments.*.user_product_resource_id' => [
                    'bail', 'nullable', 'integer', 'exists:user_product_resources,id', 'distinct',
                    new UniqueArrayValues('attachments.*.user_product_resource_id'),
                    new ExistsInResourceRelation(
                        $this->input('user_product_id'),
                        'user_products',
                        'user_product_resources',
                        'user_product_id',
                        'id'
                    )
                ]
            ],
            UserProductEnum::PREFIX->value . UserProductEnum::DESTROY->value => [
                'user_product_id' => ['bail', 'required', 'integer', 'exists:user_products,id'],
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
        };
    }

    private function getCommonRules(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:255'],
            'category' => ['bail', 'required', 'string', 'max:255'],
            'finished_date' => ['bail', 'required', 'date_format:Y-m-d'],
            'description' => ['bail', 'nullable', 'string'],

            'attachments' => ['bail', 'nullable', 'array', 'max:10'],
            'attachments.*.title' => ['bail', 'required', 'string', 'max:255'],
            'attachments.*.description' => ['bail', 'required', 'string', 'max:255'],
            'attachments.*.content_type_id' => ['bail', 'required', 'integer', 'exists:default_content_types,id']
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->normalizeDateFields(['finished_date']);
    }

    /**
     * Custom validation logic for conditional validation.
     */
    public function withValidator($validator): void
    {
        $this->processWithValidator($validator, UserProductEnum::PREFIX->value . UserProductEnum::STORE->value);
    }
}
