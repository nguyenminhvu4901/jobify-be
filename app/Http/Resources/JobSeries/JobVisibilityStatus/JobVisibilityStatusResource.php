<?php

namespace App\Http\Resources\JobSeries\JobVisibilityStatus;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobVisibilityStatusResource extends JsonResource
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
            'name' => $this->name,
        ];
    }
}
