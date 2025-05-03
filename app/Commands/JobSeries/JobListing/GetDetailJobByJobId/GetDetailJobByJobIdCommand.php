<?php

namespace App\Commands\JobSeries\JobListing\GetDetailJobByJobId;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailJobByJobIdCommand implements CommandInterface
{
    public function __construct(
        public int $jobId
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            jobId: $request->input('job_id')
        );
    }
}
