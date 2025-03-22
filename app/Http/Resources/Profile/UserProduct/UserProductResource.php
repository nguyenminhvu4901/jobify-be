<?php

namespace App\Http\Resources\Profile\UserProduct;

use App\Http\Resources\Auth\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserProductResource extends JsonResource
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
            'user' => new UserResource($this->user),
            'name' => $this->name,
            'category' => $this->category,
            'finished_date' => $this->finished_date,
            'description' => $this->description,
            'user_product_resource' => UserProductAttachmentResource::collection($this->userProductResources)
        ];
    }
}
