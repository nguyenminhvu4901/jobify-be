<?php

namespace App\Commands\Profile\UserExperience\DestroyUserExperience;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyUserExperienceCommand implements CommandInterface
{
    /**
     * @param string $userSlug
     * @param int $userExperienceId
     */
    public function __construct(
        public string $userSlug,
        public int    $userExperienceId,
    )
    {
    }

    /**
     * @param FormRequest $request
     * @return CommandInterface
     */
    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSlug: $request->get('user_slug'),
            userExperienceId: $request->get('user_experience_id')
        );
    }
}
