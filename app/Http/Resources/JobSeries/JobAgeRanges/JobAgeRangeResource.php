<?php

namespace App\Http\Resources\JobSeries\JobAgeRanges;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobAgeRangeResource extends JsonResource
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
            'min_age' => $this->min_age,
            'max_age' => $this->max_age,
            'display' => $this->display,
        ];
    }
}
