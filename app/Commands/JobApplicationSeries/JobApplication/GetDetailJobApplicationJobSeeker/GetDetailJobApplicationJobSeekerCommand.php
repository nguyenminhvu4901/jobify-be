<?php

namespace App\Commands\JobApplicationSeries\JobApplication\GetDetailJobApplicationJobSeeker;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailJobApplicationJobSeekerCommand implements CommandInterface
{
    public function __construct(
        public int $jobApplicationId,
        public int $userId,
        public int $jobListingId
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            jobApplicationId: $request->input('job_application_id'),
            userId: $request->input('user_id'),
            jobListingId: $request->input('job_listing_id')
        );
    }
}
