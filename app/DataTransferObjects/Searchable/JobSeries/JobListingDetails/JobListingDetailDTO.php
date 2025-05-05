<?php

namespace App\DataTransferObjects\Searchable\JobSeries\JobListingDetails;

readonly class JobListingDetailDTO
{
    /**
     * @param $jobDetail
     * @return array
     */
    public static function formatJobDetail($jobDetail): array
    {
        return [
            'id' => $jobDetail->id,
            'job_listing_id' => $jobDetail->job_listing_id,
            'description' => strip_tags($jobDetail->description),
            'requirement' => strip_tags($jobDetail->requirement),
            'income' => strip_tags($jobDetail->income),
            'benefit' => strip_tags($jobDetail->benefit),
            'working_hour' => strip_tags($jobDetail->working_hour)
        ];
    }
}
