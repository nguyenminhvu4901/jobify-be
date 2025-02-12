<?php

namespace App\Commands\UserExperience\DetailListOfUserExperience;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DetailListOfUserExperienceCommand implements CommandInterface
{
    public function __construct(
        public string|int $userExperienceId
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userExperienceId: $request->get('user_experience_id')
        );
    }
}
