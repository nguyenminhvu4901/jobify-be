<?php

namespace App\Http\Requests\UserSkill;

use App\Traits\FailedValidation;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserSkillRequest extends FormRequest
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
            'profile.userSkill.store' => $commonRules,
            'profile.userSkill.detailListOfUserSkill' => [
                "user_skill_id" => ['bail', 'required', 'integer', 'exists:user_skills,id']
            ],
            'profile.userSkill.detailListOfUserSkillByUserSlug' => [
                "user_slug" => ['bail', 'required', 'string', 'exists:users,slug']
            ],
           'profile.userSkill.updateUserSkill' => [
               ...$commonRules,
               'user_slug' => ['bail', 'required', 'string', 'exists:users,slug'],
               "user_skill_id" => ['bail', 'required', 'integer', 'exists:user_skills,id']
           ],
           'profile.userSkill.destroy' => [
               "user_skill_id" => ['bail', 'required', 'integer', 'exists:user_skills,id'],
               "user_slug" => ['bail', 'required', 'string', 'exists:users,slug']
           ],
            default => []
       };
    }

    /**
     * @return array[]
     */
    private function getCommonRules(): array
    {
        return [
            'name' => ['bail', 'required', 'string', 'max:512'],
            'rate_id' => ['bail', 'nullable', 'integer', 'exists:default_rates,id'],
            'description' => ['bail', 'nullable', 'string']
        ];
    }
}
