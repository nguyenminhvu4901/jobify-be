<?php

namespace App\Http\Resources\CompanySeries\CompanyWorkingDay;

use App\DataTransferObjects\Searchable\CompanySeries\CompanyWorkingDays\CompanyWorkingDayDTO;
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
        return CompanyWorkingDayDTO::formatCompanyWorkingDay($this->resource);
    }
}
