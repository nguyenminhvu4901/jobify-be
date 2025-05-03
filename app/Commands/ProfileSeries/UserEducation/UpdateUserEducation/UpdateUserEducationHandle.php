<?php

namespace App\Commands\ProfileSeries\UserEducation\UpdateUserEducation;

use App\Http\Resources\ProfileSeries\UserEducation\UserEducationResource;
use App\Repositories\ProfileSeries\UserEducation\UserEducationRepository;

class UpdateUserEducationHandle
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
     * @param UpdateUserEducationCommand $command
     * @return array
     */
    public function handle(UpdateUserEducationCommand $command): array
    {
        try {
            $result = $this->userEducationRepository->updateDataWithTransaction(
                $this->prepareUserActivityData($command),
                $command->userEducationId
            );

            if(!$result['success']){
                return [
                    'message' => $result['message'] ?? __('messages.profile.user_update_profile_error'),
                    'error' => $result['error'] ?? null
                ];
            }

            return [
                'data' => UserEducationResource::make($result['data']),
                'message' => __('messages.profile.user_update_profile_success')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e
            ];
        }
    }

    /**
     * @param UpdateUserEducationCommand $command
     * @return array
     */
    private function prepareUserActivityData(UpdateUserEducationCommand $command): array
    {
        return [
            'name' => $command->name,
            'major' => $command->major,
            'is_studying' => $command->isStudying,
            'start_date' => $command->startDate,
            'end_date' => $command->endDate,
            'description' => $command->description
        ];
    }
}
