<?php

namespace App\Commands\ProfileSeries\UserCourse\UpdateUserCourse;

use App\Http\Resources\ProfileSeries\UserCourse\UserCourseResource;
use App\Repositories\ProfileSeries\UserCourse\UserCourseRepository;
use App\Services\ProfileSeries\UserCourse\UserCourseService;

class UpdateUserCourseHandle
{
    public function __construct(
        protected UserCourseRepository $userCourseRepository,
        protected UserCourseService $userCourseService
    ) {
    }

    public function handle(UpdateUserCourseCommand $command): array
    {
        try {
            $result = $this->userCourseRepository->updateDataWithTransaction(
                $this->prepareUserActivityData($command),
                $command->userCourseId
            );

            if (! $result['success']) {
                return [
                    'message' => $result['message'] ?? __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null,
                ];
            }

            if (! empty($command->attachments)) {

                $this->userCourseService->updateResourceAttachment(
                    attachments: $command->attachments,
                    userCourseResource: $result['data']->userCourseResources,
                    userCourseId: $command->userCourseId
                );
            }

            return [
                'data' => UserCourseResource::make($result['data']),
                'message' => __('messages.profile.user_update_profile_success'),
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e,
            ];
        }
    }

    private function prepareUserActivityData(UpdateUserCourseCommand $command): array
    {
        return [
            'name' => $command->name,
            'organization' => $command->organization,
            'start_date' => $command->startDate,
            'end_date' => $command->endDate,
            'description' => $command->description,
        ];
    }
}
