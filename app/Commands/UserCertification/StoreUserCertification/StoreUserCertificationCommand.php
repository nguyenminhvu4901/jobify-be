<?php

namespace App\Commands\UserCertification\StoreUserCertification;

use App\Commands\CommandInterface;
use App\Services\AttachmentResource\AttachmentResourceService;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserCertificationCommand implements CommandInterface
{
    public function __construct(
        public readonly string $name,
        public readonly string|null $organization,
        public readonly bool $isNoExpiration,
        public readonly string $startDate,
        public readonly string|null $endDate,
        public readonly array|null $attachments
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        $attachments = AttachmentResourceService::handleAttachments($request, 'user_certification_resource_id');

        return new self(
            name: $request->get('name'),
            organization: $request->get('organization'),
            isNoExpiration: $request->get('is_no_expiration'),
            startDate: $request->get('start_date'),
            endDate: $request->get('end_date') ?? null,
            attachments: $attachments
        );
    }
}