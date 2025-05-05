<?php

namespace App\DataTransferObjects\Searchable\JobSeries\JobLocations;

use App\DataTransferObjects\Searchable\Location\LocationDTO;

readonly class JobLocationDTO
{
    /**
     * @param $jobLocation
     * @return array
     */
    public static function formatJobLocation($jobLocation): array
    {
        return [
            'id' => $jobLocation->id,
            'job_listing_id' => $jobLocation->job_listing_id,
            'branch_name' => $jobLocation->branch_name,
            'province' => LocationDTO::formatProvince($jobLocation->province),
            'district' => LocationDTO::formatDistrict($jobLocation->district),
            'ward' => LocationDTO::formatWard($jobLocation->ward),
            'address' => $jobLocation->address
        ];
    }
}
