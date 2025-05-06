<?php

namespace App\Commands\ProfileSeries\UserSkill\GetDetailListOfUserSkill;

use App\Enums\RouteNames\Profile\UserSkillEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserSkill\UserSkillResource;
use App\Repositories\ProfileSeries\UserSkill\UserSkillRepository;
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
            $cache = redisCacheDB()->tags([UserSkillEnum::TAG_NAME->value])->has(
                generateCacheName(
                    UserSkillEnum::DETAIL_LIST_USER_SKILL->value,
                    $command
                )
            );

            $userSkill = redisCacheDB()->tags([UserSkillEnum::TAG_NAME->value])
                ->remember(
                    generateCacheName(
                        UserSkillEnum::DETAIL_LIST_USER_SKILL->value,
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
