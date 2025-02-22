<?php

namespace App\Http\Resources\UserProduct;

use App\Http\Resources\DefaultContentType\DefaultContentTypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProductAttachmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_product_id' => $this->user_product_id,
            'title' => $this->title,
            'path' => $this->path,
            'description' => $this->description,
            'content_type' => new DefaultContentTypeResource($this->contentType)
        ];
    }
}
