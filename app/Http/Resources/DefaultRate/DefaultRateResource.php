<?php

namespace App\Http\Resources\DefaultRate;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DefaultRateResource extends JsonResource
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
            'rate' => $this->rate,
            'created_at' => formatDateTime($this->created_at),
            'updated_at' => formatDateTime($this->updated_at)
        ];
    }
}
