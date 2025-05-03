<?php

namespace App\Commands\ProfileSeries\UserSkill\UpdateUserSkill;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserSkillCommand implements CommandInterface
{
    public function __construct(
        public string|int $userSkillId,
        public string $userSlug,
        public string $name,
        public string|int|null $rateId,
        public ?string $description
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSkillId: $request->get('user_skill_id'),
            userSlug: $request->get('user_slug'),
            name: $request->get('name'),
            rateId: $request->get('rate_id'),
            description: $request->get('description')
        );
    }
}
