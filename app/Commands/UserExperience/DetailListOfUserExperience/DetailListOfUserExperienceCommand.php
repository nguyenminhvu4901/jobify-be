<?php

namespace App\Commands\UserExperience\DetailListOfUserExperience;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class DetailListOfUserExperienceCommand implements CommandInterface
{
    public function __construct(
        public readonly string|int $userExperienceId
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
