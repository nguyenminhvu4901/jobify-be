<?php

namespace App\Commands\UserCertification\StoreUserCertification;

use App\Commands\CommandInterface;
use App\Services\AttachmentResource\AttachmentResourceService;
use Illuminate\Foundation\Http\FormRequest;

readonly class StoreUserCertificationCommand implements CommandInterface
{
    public function __construct(
        public string      $name,
        public string|null $organization,
        public bool        $isNoExpiration,
        public string      $startDate,
        public string|null $endDate,
        public array|null  $attachments
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
