<?php

namespace App\Commands\ProfileSeries\UserCourse\StoreUserCourse;

use App\Http\Resources\ProfileSeries\UserCourse\UserCourseResource;
use App\Repositories\ProfileSeries\UserCourse\UserCourseRepository;
use App\Services\ProfileSeries\UserCourse\UserCourseService;

class StoreUserCourseHandle
{
    public function __construct(
        protected UserCourseRepository $userCourseRepository,
        protected UserCourseService $userCourseService
    ) {
    }

    public function handle(StoreUserCourseCommand $command): array
    {
        try {
            $result = $this->userCourseRepository->storeDataWithTransaction(
                $this->prepareUserActivityData($command)
            );

            if (! $result['success']) {

                return [
                    'message' => __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null,
                ];
            }

            if (! empty($command->attachments)) {
                $attachments = $command->attachments;

                foreach ($attachments as $attachment) {
                    $pathStorage = $this->userCourseService->saveAttachment($attachment);

                    if (! empty($pathStorage)) {
                        $this->userCourseService->storeUserCourseResource(
                            attachment: $attachment,
                            userCourseId: $result['data']->id,
                            pathStorage: $pathStorage
                        );
                    }
                }
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

    private function prepareUserActivityData(StoreUserCourseCommand $command): array
    {
        return [
            'user_id' => auth()->user()->id,
            'name' => $command->name,
            'organization' => $command->organization,
            'start_date' => $command->startDate,
            'end_date' => $command->endDate,
            'description' => $command->description,
        ];
    }
}
