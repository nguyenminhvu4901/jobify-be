<?php

namespace App\Commands\ProfileSeries\UserSkill\GetDetailListOfUserSkill;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailListOfUserSkillCommand implements CommandInterface
{
    public function __construct(
        public int|string $userSkillId
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSkillId: $request->get('user_skill_id')
        );
    }
}
