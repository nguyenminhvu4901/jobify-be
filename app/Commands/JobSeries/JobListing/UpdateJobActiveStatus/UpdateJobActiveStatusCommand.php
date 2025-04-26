<?php

namespace App\Commands\JobSeries\JobListing\UpdateJobActiveStatus;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class UpdateJobActiveStatusCommand implements CommandInterface
{
    /**
     * @param int $jobListingId
     * @param int $companyId
     * @param int $activeStatusId
     */
    public function __construct(
        public int $jobListingId,
        public int $companyId,
        public int $activeStatusId
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
            companyId: $request->input('company_id'),
            activeStatusId: $request->input('active_status_id')
        );
    }
}
