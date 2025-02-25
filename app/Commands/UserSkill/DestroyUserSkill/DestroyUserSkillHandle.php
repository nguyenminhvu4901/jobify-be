<?php

namespace App\Commands\UserSkill\DestroyUserSkill;

use App\Repositories\UserSkill\UserSkillRepository;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DestroyUserSkillHandle
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
     * @param DestroyUserSkillCommand $command
     * @return array
     */
    public function handle(DestroyUserSkillCommand $command): array
    {
        try {
            $userSkill = $this->userSkillRepository->findByRelationshipUserSlugAndColumnDetailId(
                $command->userSlug, $command->userSkillId
            );

            if (!$userSkill) {
                return [
                    'message' => __('messages.response.resource_not_found'),
                    'status_code' => ResponseAlias::HTTP_NOT_FOUND
                ];
            }

            $userSkillDelete = $this->userSkillRepository->destroy($userSkill);

            if ($userSkillDelete) {
                return [
                    'userSkillDelete' => true,
                    'message' => __('messages.profile.user_destroy_profile_success')
                ];
            }

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_destroy_profile_error'),
                'error' => $e,
                'status_code' => ResponseAlias::HTTP_INTERNAL_SERVER_ERROR
            ];
        }
    }
}
