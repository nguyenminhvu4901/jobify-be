<?php

namespace App\Commands\UserSkill\GetListSkillCurrentUser;

use App\Repositories\User\UserRepository;

class GetListSkillCurrentUserHandle
{
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
        $userId = auth()->user()->id;

        $userSkills = $this->userRepository->findWithRelationships(
            $userId,
            ['userSkills.rate']
        );

        if(!empty($userSkills)){
            return [
                'userSkills' => $userSkills,
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_get_profile_error')
        ];
    }
}
