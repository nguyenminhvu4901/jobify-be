<?php

namespace App\Commands\UserProduct\StoreUserProduct;

use App\Commands\CommandInterface;
use App\Services\AttachmentResource\AttachmentResourceService;
use Illuminate\Foundation\Http\FormRequest;

readonly class StoreUserProductCommand implements CommandInterface
{
    public function __construct(
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
           name: $request->get('name'),
           category: $request->get('category'),
           finishedDate: $request->get('finished_date'),
           description: $request->get('description'),
           attachments: $attachments
       );
    }
}
