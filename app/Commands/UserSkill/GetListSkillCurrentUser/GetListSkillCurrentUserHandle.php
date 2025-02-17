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
            $userId = auth()->user()->id;

            $userSkills = $this->userRepository->findWithRelationships(
                $userId,
                ['userSkills.rate']
            );

            return [
                'userSkills' => CurrentUserSkillResource::make($userSkills),
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
