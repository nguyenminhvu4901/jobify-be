<?php

namespace App\Commands\JobApplicationSeries\JobApplication\UpdateJobApplicationStatus;

use App\Enums\RouteNames\JobApplicationSeries\ApplicationStatusEnum;
use App\Http\Resources\JobApplicationSeries\ApplicationStatus\JobApplicationStatusResource;
use App\Repositories\JobApplicationSeries\JobApplicationStatus\JobApplicationStatusRepository;

class UpdateJobApplicationStatusHandler
{
    public function __construct(
        protected JobApplicationStatusRepository $jobApplicationStatusRepository
    ) {
    }

    public function handle(UpdateJobApplicationStatusCommand $command): array
    {
        try {
            $jobApplicationStatus = $this->jobApplicationStatusRepository->updateDataWithTransaction(
                $this->prepareJobApplicationStatusData($command),
                $command->jobApplicationStatusId
            );

            if (! $jobApplicationStatus['success']) {
                return [
                    'message' => __('messages.job.job_update_profile_error'),
                    'error' => $jobApplicationStatus['error'] ?? null,
                ];
            }

            return [
                'data' => JobApplicationStatusResource::make($jobApplicationStatus['data']),
                'message' => __('messages.profile.user_update_profile_success'),
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.job.job_update_profile_error'),
                'error' => $e,
            ];
        }
    }

    private function prepareJobApplicationStatusData(UpdateJobApplicationStatusCommand $command): array
    {
        $statusEnum = ApplicationStatusEnum::from($command->applicationStatusId);

        return array_filter([
            'application_status_id' => $command->applicationStatusId,
            'reject_reason' => $statusEnum->requiresRejectReason($command->applicationStatusId) ? $command->rejectReason : null,
            'hired_at' => $statusEnum->requiresHiredAt($command->applicationStatusId) ? $command->hiredAt : null,
        ], fn ($value) => ! is_null($value));
    }
}
