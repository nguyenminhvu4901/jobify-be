<?php

namespace App\Commands\UserSkill\GetDetailListOfUserSkill;

use App\Repositories\UserSkill\UserSkillRepository;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class GetDetailListOfUserSkillHandle
{
    /**
     * @param UserSkillRepository $userSkillRepository
     */
    public function __construct(
        protected UserSkillRepository $userSkillRepository
    )
    {
    }

    /**
     * @param GetDetailListOfUserSkillCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserSkillCommand $command): array
    {
        $userSkill = $this->userSkillRepository->findWithRelationships(
            $command->userSkillId,
            ['user', 'rate']
        );

        if(!empty($userSkill)){
            return [
                'userSkill' => $userSkill,
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }

        return [
            'message' => __('messages.profile.user_get_profile_error'),
            'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
        ];
    }
}
