<?php

namespace App\Commands\ProfileSeries\UserProduct\UpdateUserProduct;

use App\Commands\CommandInterface;
use App\Services\ProfileSeries\AttachmentResource\AttachmentResourceService;
use Illuminate\Foundation\Http\FormRequest;

readonly class UpdateUserProductCommand implements CommandInterface
{
    public function __construct(
        public string $userSlug,
        public string|int $userProductId,
        public string $name,
        public string $category,
        public string $finishedDate,
        public string|null $description,
        public array|null  $attachments
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        $attachments = AttachmentResourceService::handleAttachments($request, 'user_product_resource_id');

        return new self(
            userSlug: $request->get('user_slug'),
            userProductId: $request->get('user_product_id'),
            name: $request->get('name'),
            category: $request->get('category'),
            finishedDate: $request->get('finished_date'),
            description: $request->get('description'),
            attachments: $attachments
        );
    }
}
