<?php

namespace App\Commands\ProfileSeries\UserSkill\GetListSkillCurrentUser;

use App\Enums\RouteNames\Profile\UserSkillEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserSkill\CurrentUserSkillResource;
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
            $cache = redisCacheDB()->tags([UserSkillEnum::TAG_NAME->value])->has(
                UserSkillEnum::LIST_SKILL_CURRENT_USER->value . auth()->user()->id
            );

            $userSkills = redisCacheDB()->tags([UserSkillEnum::TAG_NAME->value])
                ->remember(
                    UserSkillEnum::LIST_SKILL_CURRENT_USER->value . auth()->user()->id,
                    CacheTTL::REMEMBER->value,
                    fn() => $this->userRepository->findWithRelationships(
                        auth()->user()->id,
                        ['userSkills.rate']
                    )
                );

            if(empty($userSkills)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => CurrentUserSkillResource::make($userSkills),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
