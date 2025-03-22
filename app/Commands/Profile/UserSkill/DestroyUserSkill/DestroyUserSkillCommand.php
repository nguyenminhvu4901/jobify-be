<?php

namespace App\Commands\Profile\UserSkill\DestroyUserSkill;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyUserSkillCommand implements CommandInterface
{
    /**
     * @param string $userSlug
     * @param int|string $userSkillId
     */
    public function __construct(
        public string     $userSlug,
        public int|string $userSkillId,
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
            userSkillId: $request->get('user_skill_id')
        );
    }
}
