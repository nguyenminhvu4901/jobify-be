<?php

namespace App\Commands\ProfileSeries\UserSkill\GetDetailListOfUserSkillByUserSlug;

use App\Enums\RouteNames\Profile\UserSkillEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserSkill\UserSkillResource;
use App\Repositories\ProfileSeries\UserSkill\UserSkillRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserSkillByUserSlugHandle
{
    public function __construct(
        protected UserSkillRepository $userSkillRepository
    ) {
    }

    public function handle(GetDetailListOfUserSkillByUserSlugCommand $command): array
    {
        try {
            $cache = Cache::tags([UserSkillEnum::TAG_NAME->value])->has(
                generateCacheName(
                    UserSkillEnum::DETAIL_LIST_USER_SKILL_BY_USER_SLUG->value,
                    $command
                )
            );

            $userSkills = Cache::tags([UserSkillEnum::TAG_NAME->value])
                ->remember(
                    generateCacheName(
                        UserSkillEnum::DETAIL_LIST_USER_SKILL_BY_USER_SLUG->value,
                        $command
                    ),
                    CacheTTL::REMEMBER->value,
                    fn () => $this->userSkillRepository->getByRelationshipUserSlug(
                        $command->userSlug,
                        ['user', 'rate']
                    )
                );

            return [
                'data' => UserSkillResource::collection($userSkills),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache,
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e,
            ];
        }
    }
}
