<?php

namespace App\Http\Requests\UserProduct;

use App\Rules\ExistsInResourceRelation;
use App\Traits\CustomDate\NormalizeDateTrait;
use App\Traits\CustomValidatorAfter\ValidatesAttachmentsTrait;
use App\Traits\FailedValidation;
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
            "profile.userProduct.detailListOfUserProduct" => [
                'user_product_id' => ['bail', 'required', 'integer', 'exists:user_products,id']
            ],
            "profile.userProduct.detailListOfUserProductByUserSlug" => [
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
            ],
            "profile.userProduct.store" => $commonRules,
            "profile.userProduct.updateProduct" => [
                ...$commonRules,
                'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
                'user_product_id' => ['bail', 'required', 'integer', 'exists:user_products,id'],
                'attachments.*.user_product_resource_id' => [
                    'bail', 'nullable', 'integer', 'exists:user_product_resources,id',
                    new ExistsInResourceRelation(
                        $this->input('user_product_id'),
                        'user_products',
                        'user_product_resources',
                        'user_product_id',
                        'id'
                    )
                ]
            ],
            "profile.userProduct.destroy" => [
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
        $this->processWithValidator($validator, "profile.userProduct.store");
    }
}
