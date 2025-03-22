<?php

namespace App\Commands\Profile\UserSkill\GetDetailListOfUserSkillByUserSlug;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailListOfUserSkillByUserSlugCommand implements CommandInterface
{
    /**
     * @param string $userSlug
     */
    public function __construct(
        public string $userSlug
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
            userSlug: $request->get('user_slug')
        );
    }
}
