<?php

namespace App\Commands\UserEducation\GetDetailListOfUserEducation;

use App\Http\Resources\UserEducation\UserEducationResource;
use App\Repositories\UserEducation\UserEducationRepository;

class GetDetailListOfUserEducationHandle
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
     * @param GetDetailListOfUserEducationCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserEducationCommand $command): array
    {
        try {
            $userEducation = $this->userEducationRepository->findWithRelationships(
                $command->userEducationId,
                'user'
            );

            if(empty($userEducation)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => UserEducationResource::make($userEducation),
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
