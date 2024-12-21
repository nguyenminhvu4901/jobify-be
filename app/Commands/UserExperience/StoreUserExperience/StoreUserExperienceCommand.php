<?php

namespace App\Commands\UserExperience\StoreUserExperience;

use App\Commands\CommandInterface;
use App\Services\UserExperience\UserExperienceService;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserExperienceCommand implements CommandInterface
{
    public function __construct(
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
            name: $request->get('name'),
            position: $request->get('position'),
            isWorking: $request->get('is_working'),
            startDate: $request->get('start_date'),
            endDate: $request->get('end_date') ?? null,
            attachments: $attachments
        );
    }
}
