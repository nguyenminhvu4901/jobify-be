<?php

namespace App\Commands\UserSkill\GetListSkillCurrentUser;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserSkill;
use App\Http\Resources\Profile\UserSkill\CurrentUserSkillResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Cache;

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
            $cache = Cache::tags([UserSkill::TAG_NAME->value])->has(
                UserSkill::LIST_SKILL_CURRENT_USER->value . auth()->user()->id
            );

            $userSkills = Cache::tags([UserSkill::TAG_NAME->value])
                ->remember(
                    UserSkill::LIST_SKILL_CURRENT_USER->value . auth()->user()->id,
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
