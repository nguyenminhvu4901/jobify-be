<?php

namespace App\DataTransferObjects\Searchable\JobSeries\JobContacts;

readonly class JobContactDTO
{
    /**
     * @param $contact
     * @return array
     */
    public static function formatJobContact($contact): array
    {
        return [
            'id' => $contact->id,
            'job_listing_id' => $contact->job_listing_id,
            'full_name' => $contact->full_name,
            'email' => $contact->email,
            'phone_number' => $contact->phone_number
        ];
    }
}
