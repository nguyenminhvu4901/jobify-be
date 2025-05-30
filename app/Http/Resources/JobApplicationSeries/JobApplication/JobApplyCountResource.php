<?php

namespace App\Http\Resources\JobApplicationSeries\JobApplication;

use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobApplyCountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $max = (int) JobApplicationEnum::MAX_APPLIES->value;

        return [
            'applied_count' => $this->resource,
            'remaining_applies' => max(0, $max - $this->resource),
            'can_apply' => $this->resource < $max
        ];
    }
}
