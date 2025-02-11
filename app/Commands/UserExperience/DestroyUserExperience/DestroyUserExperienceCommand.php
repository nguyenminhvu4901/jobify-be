<?php

namespace App\Commands\UserExperience\DestroyUserExperience;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyUserExperienceCommand implements CommandInterface
{
    public function __construct(
        public string $userSlug,
        public int    $userExperienceId,
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSlug: $request->get('user_slug'),
            userExperienceId: $request->get('user_experience_id')
        );
    }
}
