<?php

namespace App\Commands\ProfileSeries\UserCertification\UpdateUserCertification;

use App\Commands\CommandInterface;
use App\Services\ProfileSeries\AttachmentResource\AttachmentResourceService;
use Illuminate\Foundation\Http\FormRequest;

readonly class UpdateUserCertificationCommand implements CommandInterface
{
    public function __construct(
        public string $userSlug,
        public int $userCertificationId,
        public string $name,
        public ?string $organization,
        public bool $isNoExpiration,
        public string $startDate,
        public ?string $endDate,
        public ?array $attachments
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        $attachments = AttachmentResourceService::handleAttachments($request, 'user_certification_resource_id');

        return new self(
            userSlug: $request->get('user_slug'),
            userCertificationId: $request->get('user_certification_id'),
            name: $request->get('name'),
            organization: $request->get('organization') ?? null,
            isNoExpiration: $request->get('is_no_expiration'),
            startDate: $request->get('start_date'),
            endDate: $request->get('end_date') ?? null,
            attachments: $attachments
        );
    }
}
