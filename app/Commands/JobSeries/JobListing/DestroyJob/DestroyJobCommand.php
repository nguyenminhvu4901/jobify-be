<?php

namespace App\Commands\JobSeries\JobListing\DestroyJob;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyJobCommand implements CommandInterface
{
    /**
     * @param int $jobListingId
     * @param int $companyId
     */
    public function __construct(
        public int $jobListingId,
        public int $companyId
    )
    {
    }

    /**
     * @param FormRequest $request
     * @return CommandInterface
     */
    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            jobListingId: $request->input('job_listing_id'),
            companyId: $request->input('company_id')
        );
    }
}
