<?php

namespace App\Commands\ProfileSeries\UserSkill\GetCompleteListOfUserSkill;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserSkillEnum;
use App\Http\Resources\ProfileSeries\UserSkill\UserSkillResource;
use App\Repositories\ProfileSeries\UserSkill\UserSkillRepository;
use Illuminate\Support\Facades\Cache;

class GetCompleteListOfUserSkillHandle
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
     * @param GetCompleteListOfUserSkillCommand $command
     * @return array
     */
    public function handle(GetCompleteListOfUserSkillCommand $command): array
    {
        try {
            $cache = Cache::tags([UserSkillEnum::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        UserSkillEnum::COMPLETE_LIST_USER_SKILL->value,
                        $command
                    )
                );

            $userSkills = Cache::tags([UserSkillEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserSkillEnum::COMPLETE_LIST_USER_SKILL->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userSkillRepository->paginateWithRelationship(
                    relationship: ['rate', 'user'],
                    limit:  $command->limit
                )
            );

            return [
                'data' => UserSkillResource::collection($userSkills),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache,
                'pagination' => formatPaginationData($userSkills ?? [])
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
