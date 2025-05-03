<?php

namespace App\Commands\ProfileSeries\UserExperience\UpdateUserExperience;

use App\Commands\CommandInterface;
use App\Services\ProfileSeries\AttachmentResource\AttachmentResourceService;
use Illuminate\Foundation\Http\FormRequest;

readonly class UpdateUserExperienceCommand implements CommandInterface
{
    public function __construct(
        public string $userSlug,
        public int $userExperienceId,
        public string $name,
        public string $position,
        public bool $isWorking,
        public string $startDate,
        public ?string $endDate,
        public ?array $attachments
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        $attachments = AttachmentResourceService::handleAttachments($request, 'user_experience_resource_id');

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
