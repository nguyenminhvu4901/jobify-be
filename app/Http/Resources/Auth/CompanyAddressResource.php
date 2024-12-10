<?php

namespace App\Http\Resources\Auth;

use App\Http\Resources\District\DistrictResource;
use App\Http\Resources\Province\ProvinceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyAddressResource extends JsonResource
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
            'company_id' => $this->company_id,
            'province' => new ProvinceResource($this->province),
            'district' => new DistrictResource($this->district)
        ];
    }
}
