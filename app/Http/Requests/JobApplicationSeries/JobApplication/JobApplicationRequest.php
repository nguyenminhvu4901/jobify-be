<?php

namespace App\Http\Requests\JobApplicationSeries\JobApplication;

use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use App\Traits\ValidationResponse\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class JobApplicationRequest extends FormRequest
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
            JobApplicationEnum::PREFIX->value . JobApplicationEnum::DETAIL_JOB_APPLICATION_JOB_SEEKER->value => [
                'job_application_id' => ['bail', 'required', 'integer', 'exists:job_applications,id'],
                'user_id' => ['bail', 'required', 'integer', 'exists:users,id'],
                'job_listing_id' => ['bail', 'required', 'integer', 'exists:job_listings,id']
            ],
            JobApplicationEnum::PREFIX->value . JobApplicationEnum::LIST_JOB_APPLICATION_JOB_SEEKER->value => [
                'user_id' => ['bail', 'required', 'integer', 'exists:users,id'],
            ],
            JobApplicationEnum::PREFIX->value . JobApplicationEnum::LIST_JOB_SEEKER_APPLY_JOB->value => [
                'job_listing_id' => ['bail', 'required', 'integer', 'exists:job_listings,id']
            ],
            JobApplicationEnum::PREFIX->value . JobApplicationEnum::GET_JOB_APPLY_COUNT->value => [
                'user_id' => ['bail', 'required', 'integer', 'exists:users,id'],
                'job_listing_id' => ['bail', 'required', 'integer', 'exists:job_listings,id']
            ],
            default => []
        };
    }
}
