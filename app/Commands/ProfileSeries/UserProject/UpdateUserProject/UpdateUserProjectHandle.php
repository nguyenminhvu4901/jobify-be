<?php

namespace App\Commands\ProfileSeries\UserProject\UpdateUserProject;

use App\Http\Resources\ProfileSeries\UserProject\UserProjectResource;
use App\Repositories\ProfileSeries\UserProject\UserProjectRepository;
use App\Services\ProfileSeries\UserProject\UserProjectService;

class UpdateUserProjectHandle
{
    public function __construct(
        protected UserProjectRepository $userProjectRepository,
        protected UserProjectService $userProjectService
    ) {
    }

    public function handle(UpdateUserProjectCommand $command): array
    {
        try {
            $result = $this->userProjectRepository->updateDataWithTransaction(
                $this->prepareUserActivityData($command),
                $command->userProjectId
            );

            if (! $result['success']) {
                return [
                    'message' => $result['message'] ?? __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null,
                ];
            }

            if (! empty($command->attachments)) {

                $this->userProjectService->updateResourceAttachment(
                    attachments: $command->attachments,
                    userProjectResource: $result['data']->userProjectResources,
                    userProjectId: $command->userProjectId
                );
            }

            return [
                'data' => UserProjectResource::make($result['data']),
                'message' => __('messages.profile.user_update_profile_success'),
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e,
            ];
        }
    }

    private function prepareUserActivityData(UpdateUserProjectCommand $command): array
    {
        return [
            'name' => $command->name,
            'client' => $command->client,
            'member' => $command->member,
            'position' => $command->position,
            'mission' => $command->mission,
            'technology' => $command->technology,
            'is_working' => $command->isWorking,
            'start_date' => $command->startDate,
            'end_date' => $command->endDate,
            'description' => $command->description,
        ];
    }
}
