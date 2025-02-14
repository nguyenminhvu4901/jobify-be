<?php

namespace App\Commands\UserSkill\StoreUserSkill;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class StoreUserSkillCommand implements CommandInterface
{
    /**
     * @param string $name
     * @param string|int|null $rateId
     * @param string|null $description
     */
    public function __construct(
        public string $name,
        public string|int|null $rateId,
        public string|null $description
    )
    {}

    /**
     * @param FormRequest $request
     * @return CommandInterface
     */
    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            name: $request->get('name'),
            rateId: $request->get('rate_id'),
            description: $request->get('description')
        );
    }
}
