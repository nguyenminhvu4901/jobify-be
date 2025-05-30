<?php

namespace App\Commands\JobApplicationSeries\JobApplication\GetJobApplyCount;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetJobApplyCountCommand implements CommandInterface
{
    public function __construct(
        public int $userId,
        public int $jobListingId
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userId: $request->input('user_id'),
            jobListingId: $request->input('job_listing_id')
        );
    }
}
