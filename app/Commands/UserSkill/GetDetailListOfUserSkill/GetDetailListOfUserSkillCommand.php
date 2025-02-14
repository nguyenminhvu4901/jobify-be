<?php

namespace App\Commands\UserSkill\GetDetailListOfUserSkill;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailListOfUserSkillCommand implements CommandInterface
{
    /**
     * @param int|string $userSkillId
     */
    public function __construct(
        public int|string $userSkillId
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
            userSkillId: $request->get('user_skill_id')
        );
    }
}
