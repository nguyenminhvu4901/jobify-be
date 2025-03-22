<?php

namespace App\Commands\ProfileSeries\UserPrize\UpdateUserPrize;

use App\Commands\CommandInterface;
use App\Services\AttachmentResource\AttachmentResourceService;
use Illuminate\Foundation\Http\FormRequest;

readonly class UpdateUserPrizeCommand implements CommandInterface
{
    public function __construct(
        public string|int $userPrizeId,
        public string $userSlug,
        public string $name,
        public string|null $organization,
        public string $startDate,
        public string|null $endDate,
        public array|null  $attachments
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        $attachments = AttachmentResourceService::handleAttachments($request, 'user_prize_resource_id');

        return new self(
            userPrizeId: $request->get('user_prize_id'),
            userSlug: $request->get('user_slug'),
            name: $request->get('name'),
            organization: $request->get('organization') ?? null,
            startDate: $request->get('start_date'),
            endDate: $request->get('end_date') ?? null,
            attachments: $attachments
        );
    }
}
