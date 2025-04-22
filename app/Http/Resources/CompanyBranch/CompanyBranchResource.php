<?php

namespace App\Http\Resources\CompanyBranch;

use App\Http\Resources\Locate\District\DistrictDefaultResource;
use App\Http\Resources\Locate\Province\ProvinceResource;
use App\Http\Resources\Locate\Ward\WardDefaultResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyBranchResource extends JsonResource
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
            'branch_name' => $this->branch_name,
            'province' => new ProvinceResource($this->province),
            'district' => new DistrictDefaultResource($this->district),
            'ward' => new WardDefaultResource($this->ward),
            'address' => $this->address
        ];
    }
}
