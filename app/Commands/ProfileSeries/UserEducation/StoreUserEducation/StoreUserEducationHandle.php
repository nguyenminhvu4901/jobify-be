<?php

namespace App\Commands\ProfileSeries\UserEducation\StoreUserEducation;

use App\Http\Resources\ProfileSeries\UserEducation\UserEducationResource;
use App\Repositories\ProfileSeries\UserEducation\UserEducationRepository;

class StoreUserEducationHandle
{
    /**
     * @param UserEducationRepository $userEducationRepository
     */
    public function __construct(
        protected UserEducationRepository $userEducationRepository
    )
    {
    }

    /**
     * @param StoreUserEducationCommand $command
     * @return array
     */
    public function handle(StoreUserEducationCommand $command): array
    {
        try {
            $result = $this->userEducationRepository->storeDataWithTransaction(
                $this->prepareUserActivityData($command)
            );

            if(!$result['success']){

                return [
                    'message' => __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null,
                ];
            }

            $result['data']->load('user');

            return [
                'data' => UserEducationResource::make($result['data']),
                'message' => __('messages.profile.user_update_profile_success')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.user_update_profile_error'),
                'error' => $e
            ];
        }
    }

    /**
     * @param StoreUserEducationCommand $command
     * @return array
     */
    private function prepareUserActivityData(StoreUserEducationCommand $command): array
    {
        return [
            'user_id' => auth()->user()?->id,
            'name' => $command->name,
            'major' => $command->major,
            'is_studying' => $command->isStudying,
            'start_date' => $command->startDate,
            'end_date' => $command->endDate,
            'description' => $command->description
        ];
    }
}
