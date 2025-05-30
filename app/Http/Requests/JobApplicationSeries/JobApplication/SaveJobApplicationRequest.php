<?php

namespace App\Http\Requests\JobApplicationSeries\JobApplication;

use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use App\Rules\PhoneNumberRule;
use App\Traits\ValidationResponse\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SaveJobApplicationRequest extends FormRequest
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
            JobApplicationEnum::PREFIX->value . JobApplicationEnum::STORE_JOB_SEEKER_APPLY_JOB->value => [
                'user_id' => ['bail', 'required', 'integer', 'exists:users,id'],
                'job_listing_id' => ['bail', 'required', 'integer', 'exists:job_listings,id'],
                'full_name' => ['bail', 'required', 'string'],
                'email' => ['bail', 'required', 'email', 'string'],
                'phone_number' => ['bail', 'required', 'string', new PhoneNumberRule()],
                'cover_letter' => ['bail', 'nullable', 'string', 'max:512'],
                'application_cv' => ['bail', 'required', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
            ],
            default => []
        };
    }
}
