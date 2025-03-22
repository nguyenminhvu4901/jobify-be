<?php

namespace App\Commands\UserExperience\DetailListOfUserExperienceByUserSlug;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserExperience;
use App\Http\Resources\Profile\UserExperience\UserExperienceResource;
use App\Repositories\UserExperience\UserExperienceRepository;
use Illuminate\Support\Facades\Cache;

class DetailListOfUserExperienceByUserSlugHandle
{
    /**
     * @param UserExperienceRepository $userExperienceRepository
     */
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository
    )
    {
    }

    /**
     * @param DetailListOfUserExperienceByUserSlugCommand $command
     * @return array
     */
    public function handle(DetailListOfUserExperienceByUserSlugCommand $command): array
    {
        try {
            $cache = Cache::tags([UserExperience::TAG_NAME->value])->has(
                generateCacheName(
                    UserExperience::DETAIL_LIST_USER_EXPERIENCE_BY_USER_SLUG->value,
                    $command
                )
            );

            $userExperiences = Cache::tags([UserExperience::TAG_NAME->value])->remember(
                generateCacheName(
                    UserExperience::DETAIL_LIST_USER_EXPERIENCE_BY_USER_SLUG->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userExperienceRepository->getByRelationshipUserSlug(
                    userSlug: $command->userSlug,
                    relationship: ['userExperienceResource.contentType', 'user']
                )
            );

            return [
                'data' => UserExperienceResource::collection($userExperiences),
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
