<?php

namespace App\Commands\UserSkill\GetDetailListOfUserSkill;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserSkill;
use App\Http\Resources\Profile\UserSkill\UserSkillResource;
use App\Repositories\UserSkill\UserSkillRepository;
use Illuminate\Support\Facades\Cache;
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
            $cache = Cache::tags([UserSkill::TAG_NAME->value])->has(
                generateCacheName(
                    UserSkill::DETAIL_LIST_USER_SKILL->value,
                    $command
                )
            );

            $userSkill = Cache::tags([UserSkill::TAG_NAME->value])
                ->remember(
                    generateCacheName(
                        UserSkill::DETAIL_LIST_USER_SKILL->value,
                        $command
                    ),
                    CacheTTL::REMEMBER->value,
                    fn() => $this->userSkillRepository->findWithRelationships(
                        $command->userSkillId,
                        ['user', 'rate']
                    )
                );

            if(empty($userSkill)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => UserSkillResource::make($userSkill),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache
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
