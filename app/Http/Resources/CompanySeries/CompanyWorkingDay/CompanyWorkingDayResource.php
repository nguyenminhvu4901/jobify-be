<?php

namespace App\Http\Resources\CompanySeries\CompanyWorkingDay;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyWorkingDayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this?->id,
            'working_day' => $this?->working_day,
        ];
    }
}
