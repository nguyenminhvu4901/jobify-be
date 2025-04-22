<?php

namespace App\Commands\ProfileSeries\UserActivity\UpdateUserActivity;

use App\Commands\CommandInterface;
use App\Services\ProfileSeries\AttachmentResource\AttachmentResourceService;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserActivityCommand implements CommandInterface
{
    public function __construct(
        public string $userSlug,
        public string|int $userActivityId,
        public string $name,
        public string $position,
        public string $startDate,
        public string|null $endDate,
        public string|null $description,
        public array|null  $attachments
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        $attachments = AttachmentResourceService::handleAttachments($request, 'user_activity_resource_id');

        return new self(
            userSlug: $request->get('user_slug'),
            userActivityId: $request->get('user_activity_id'),
            name: $request->get('name'),
            position: $request->get('position'),
            startDate: $request->get('start_date'),
            endDate: $request->get('end_date') ?? null,
            description: $request->get('description') ?? null,
            attachments: $attachments
        );
    }
}
