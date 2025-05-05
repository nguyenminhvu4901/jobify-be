<?php

namespace App\Http\Resources\JobSeries\JobContact;

use App\DataTransferObjects\Searchable\JobSeries\JobContacts\JobContactDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return JobContactDTO::formatJobContact($this->resource);
    }
}
