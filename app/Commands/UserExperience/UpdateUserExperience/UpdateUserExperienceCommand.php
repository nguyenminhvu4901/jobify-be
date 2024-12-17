<?php

namespace App\Commands\UserExperience\UpdateUserExperience;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserExperienceCommand implements CommandInterface
{
    public function __construct(
        public readonly string $userSlug,
        public readonly int $userExperienceId,
        public readonly ?string $name,
        public readonly ?string $position,
        public readonly ?bool $isWorking,
        public readonly ?string $startDate,
        public readonly ?string $endDate
    )
    {
    }

    public static function withForm(FormRequest $request, string $userSlug = '', int $userExperienceId = null): CommandInterface
    {
        return new self(
            userSlug: $userSlug,
            userExperienceId: $userExperienceId,
            name: $request->get('name'),
            position: $request->get('position'),
            isWorking: $request->get('is_working'),
            startDate: $request->get('start_date'),
            endDate: $request->get('end_date') ?? null
        );
    }
}
