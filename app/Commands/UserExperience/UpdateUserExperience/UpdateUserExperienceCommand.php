<?php

namespace App\Commands\UserExperience\UpdateUserExperience;

use App\Commands\CommandInterface;
use App\Services\UserExperience\UserExperienceService;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserExperienceCommand implements CommandInterface
{
    public function __construct(
        public readonly string $userSlug,
        public readonly int $userExperienceId,
        public readonly string $name,
        public readonly string $position,
        public readonly bool $isWorking,
        public readonly string $startDate,
        public readonly string|null $endDate,
        public readonly array|null $attachments
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {

        $attachments = UserExperienceService::handleAttachments($request);

        return new self(
            userSlug: $request->get('user_slug'),
            userExperienceId: $request->get('user_experience_id'),
            name: $request->get('name'),
            position: $request->get('position'),
            isWorking: $request->get('is_working'),
            startDate: $request->get('start_date'),
            endDate: $request->get('end_date') ?? null,
            attachments: $attachments
        );
    }
}
