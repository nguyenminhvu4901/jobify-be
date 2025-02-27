<?php

namespace App\Commands\UserSkill\GetDetailListOfUserSkill;

use App\Http\Resources\UserSkill\UserSkillResource;
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
        try {
            $userSkill = $this->userSkillRepository->findWithRelationships(
                $command->userSkillId,
                ['user', 'rate']
            );

            if(empty($userSkill)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => UserSkillResource::make($userSkill),
                'message' => __('messages.profile.user_get_profile_success')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
    }
}
