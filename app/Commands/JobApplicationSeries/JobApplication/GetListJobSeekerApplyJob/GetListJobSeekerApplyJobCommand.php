<?php

namespace App\Commands\JobApplicationSeries\JobApplication\GetListJobSeekerApplyJob;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetListJobSeekerApplyJobCommand implements CommandInterface
{
    public function __construct(
        public int $jobListingId,
        public ?int $limit,
        public ?string $page
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            jobListingId: $request->input('job_listing_id'),
            limit: $request->input('limit') ?? null,
            page: $request->input('page') ?? null,
        );
    }
}
