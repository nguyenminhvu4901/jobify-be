<?php

namespace App\Http\Resources\JobSeries\JobLocation;

use App\Http\Resources\Locate\District\DistrictDefaultResource;
use App\Http\Resources\Locate\Province\ProvinceResource;
use App\Http\Resources\Locate\Ward\WardDefaultResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobLocationResource extends JsonResource
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
            'job_listing_id' => $this->job_listing_id,
            'branch_name' => $this->branch_name,
            'province' => ProvinceResource::make($this->province),
            'district' => DistrictDefaultResource::make($this->district),
            'ward' => WardDefaultResource::make($this->ward),
            'address' => $this->address,
        ];
    }
}
