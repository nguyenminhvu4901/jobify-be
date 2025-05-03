<?php

namespace App\Commands\JobApplicationSeries\JobApplication\UpdateJobApplicationStatus;

use App\Commands\CommandInterface;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

readonly class UpdateJobApplicationStatusCommand implements CommandInterface
{
    public function __construct(
        public int $jobApplicationId,
        public int $applicationStatusId,
        public int $jobApplicationStatusId,
        public ?string $rejectReason,
        public ?Carbon $hiredAt
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            jobApplicationId: $request->input('job_application_id'),
            applicationStatusId: $request->input('application_status_id'),
            jobApplicationStatusId: $request->input('job_application_status_id'),
            rejectReason: $request->input('reject_reason'),
            hiredAt: $request->filled('hired_at') ?
                Carbon::createFromFormat('Y-m-d', $request->input('hired_at')) :
                null,
        );
    }
}
