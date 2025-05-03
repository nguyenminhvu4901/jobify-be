<?php

namespace App\Commands\ProfileSeries\UserCourse\StoreUserCourse;

use App\Commands\CommandInterface;
use App\Services\ProfileSeries\AttachmentResource\AttachmentResourceService;
use Illuminate\Foundation\Http\FormRequest;

readonly class StoreUserCourseCommand implements CommandInterface
{
    public function __construct(
        public string $name,
        public ?string $organization,
        public string $startDate,
        public ?string $endDate,
        public ?string $description,
        public ?array $attachments
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        $attachments = AttachmentResourceService::handleAttachments($request, 'user_course_resource_id');

        return new self(
            name: $request->get('name'),
            organization: $request->get('organization') ?? null,
            startDate: $request->get('start_date'),
            endDate: $request->get('end_date') ?? null,
            description: $request->get('description') ?? null,
            attachments: $attachments
        );
    }
}
