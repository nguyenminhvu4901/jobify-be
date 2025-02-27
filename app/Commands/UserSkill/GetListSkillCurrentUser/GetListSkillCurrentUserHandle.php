<?php

namespace App\Commands\UserSkill\GetListSkillCurrentUser;

use App\Http\Resources\UserSkill\CurrentUserSkillResource;
use App\Repositories\User\UserRepository;

class GetListSkillCurrentUserHandle
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        protected UserRepository $userRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $userSkills = $this->userRepository->findWithRelationships(
                auth()->user()->id,
                ['userSkills.rate']
            );

            if(empty($userSkills)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => CurrentUserSkillResource::make($userSkills),
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
