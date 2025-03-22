<?php

namespace App\Commands\UserSkill\GetDetailListOfUserSkillByUserSlug;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserSkill;
use App\Http\Resources\Profile\UserSkill\UserSkillResource;
use App\Repositories\UserSkill\UserSkillRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserSkillByUserSlugHandle
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
     * @param GetDetailListOfUserSkillByUserSlugCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserSkillByUserSlugCommand $command): array
    {
        try {
            $cache = Cache::tags([UserSkill::TAG_NAME->value])->has(
                generateCacheName(
                    UserSkill::DETAIL_LIST_USER_SKILL_BY_USER_SLUG->value,
                    $command
                ));

            $userSkills = Cache::tags([UserSkill::TAG_NAME->value])
                ->remember(
                    generateCacheName(
                        UserSkill::DETAIL_LIST_USER_SKILL_BY_USER_SLUG->value,
                        $command
                    ),
                    CacheTTL::REMEMBER->value,
                    fn() => $this->userSkillRepository->getByRelationshipUserSlug(
                        $command->userSlug,
                        ['user', 'rate']
                    )
                );

            return [
                'data' => UserSkillResource::collection($userSkills),
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
