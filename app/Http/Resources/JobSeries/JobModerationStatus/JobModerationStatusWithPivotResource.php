<?php

namespace App\Http\Resources\JobSeries\JobModerationStatus;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobModerationStatusWithPivotResource extends JsonResource
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
            'note' => optional($this->pivot)->note,
            'created_by' => optional($this->created_by)->created_by,
        ];
    }
}
