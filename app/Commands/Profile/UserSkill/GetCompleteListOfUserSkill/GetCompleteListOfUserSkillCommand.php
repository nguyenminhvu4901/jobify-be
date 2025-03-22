<?php

namespace App\Commands\Profile\UserSkill\GetCompleteListOfUserSkill;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetCompleteListOfUserSkillCommand implements CommandInterface
{
    /**
     * @param int|null $page
     * @param int|null $limit
     */
    public function __construct(
        public int|null $page,
        public int|null $limit
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
            page: $request->input('page') ?? null,
            limit: $request->input('limit') ?? null
        );
    }
}
