<?php

namespace App\Commands\Profile\UserCertification\UpdateUserCertification;

use App\Commands\CommandInterface;
use App\Services\AttachmentResource\AttachmentResourceService;
use Illuminate\Foundation\Http\FormRequest;

readonly class UpdateUserCertificationCommand implements CommandInterface
{
    /**
     * @param string $userSlug
     * @param int $userCertificationId
     * @param string $name
     * @param string|null $organization
     * @param bool $isNoExpiration
     * @param string $startDate
     * @param string|null $endDate
     * @param array|null $attachments
     */
    public function __construct(
        public string      $userSlug,
        public int         $userCertificationId,
        public string      $name,
        public string|null $organization,
        public bool        $isNoExpiration,
        public string      $startDate,
        public string|null $endDate,
        public array|null  $attachments
    )
    {
    }

    /**
     * @param FormRequest $request
     * @return CommandInterface
     */
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
