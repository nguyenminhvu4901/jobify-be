<?php

namespace App\Http\Requests\JobApplicationSeries\JobApplication;

use App\Enums\RouteNames\JobApplicationSeries\ApplicationStatusEnum;
use App\Rules\JobApplicationSeries\JobApplicationStatus\JobApplicationBelongsToJobApplicationStatusRule;
use App\Traits\CustomDate\NormalizeDateTrait;
use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobApplicationStatusRequest extends FormRequest
{
    use FailedValidation;
    use NormalizeDateTrait;

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
        return [
            'job_application_id' => ['bail', 'required', 'integer', 'exists:job_applications,id'],
            'application_status_id' => ['bail', 'required', 'integer', 'exists:application_statuses,id'],
            'job_application_status_id' => [
                'bail', 'required', 'integer', 'exists:job_application_status,id',
                new JobApplicationBelongsToJobApplicationStatusRule($this->input('job_application_id')),
            ],
            'reject_reason' => [
                'bail',
                Rule::requiredIf(ApplicationStatusEnum::requiresRejectReason($this->input('application_status_id'))),
                'nullable', 'string', 'max:512',
            ],
            'hired_at' => [
                'bail',
                Rule::requiredIf(ApplicationStatusEnum::requiresHiredAt($this->input('application_status_id'))),
                'nullable', 'date',
            ],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->normalizeDateFields(['hired_at']);
    }
}
