<?php

namespace App\Http\Resources\CompanyBranch;

use App\Http\Resources\Locate\District\DistrictResource;
use App\Http\Resources\Locate\Province\ProvinceResource;
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
            'district' => new DistrictResource($this->district),
            'ward' => new DistrictResource($this->ward),
            'address' => $this->address
        ];
    }
}
