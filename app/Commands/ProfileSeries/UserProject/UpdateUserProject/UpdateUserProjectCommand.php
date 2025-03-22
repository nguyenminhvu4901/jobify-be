<?php

namespace App\Commands\ProfileSeries\UserProject\UpdateUserProject;

use App\Commands\CommandInterface;
use App\Services\AttachmentResource\AttachmentResourceService;
use Illuminate\Foundation\Http\FormRequest;

readonly class UpdateUserProjectCommand implements CommandInterface
{
    public function __construct(
        public string $userSlug,
        public int    $userProjectId,
        public string $name,
        public string $client,
        public string $member,
        public string $position,
        public string $mission,
        public string|null $technology,
        public bool $isWorking,
        public string $startDate,
        public string|null $endDate,
        public string|null $description,
        public array|null  $attachments
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        $attachments = AttachmentResourceService::handleAttachments($request, 'user_project_resource_id');

        return new self(
            userSlug: $request->get('user_slug'),
            userProjectId: $request->get('user_project_id'),
            name: $request->get('name'),
            client: $request->get('client'),
            member: $request->get('member'),
            position: $request->get('position'),
            mission: $request->get('mission'),
            technology: $request->get('technology') ?? null,
            isWorking: $request->get('is_working'),
            startDate: $request->get('start_date'),
            endDate: $request->get('end_date') ?? null,
            description: $request->get('description'),
            attachments: $attachments
        );
    }
}
