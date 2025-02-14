<?php

namespace App\Commands\UserSkill\StoreUserSkill;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class StoreUserSkillCommand implements CommandInterface
{
    public function __construct(
        public string $name,
        public string|int|null $rateId,
        public string|null $description
    )
    {}

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            name: $request->get('name'),
            rateId: $request->get('rate_id'),
            description: $request->get('description')
        );
    }
}
