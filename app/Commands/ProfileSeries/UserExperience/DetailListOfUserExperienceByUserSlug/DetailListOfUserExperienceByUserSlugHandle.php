<?php

namespace App\Commands\ProfileSeries\UserExperience\DetailListOfUserExperienceByUserSlug;

use App\Enums\RouteNames\Profile\UserExperienceEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserExperience\UserExperienceResource;
use App\Repositories\ProfileSeries\UserExperience\UserExperienceRepository;
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
            $cache = Cache::tags([UserExperienceEnum::TAG_NAME->value])->has(
                generateCacheName(
                    UserExperienceEnum::DETAIL_LIST_USER_EXPERIENCE_BY_USER_SLUG->value,
                    $command
                )
            );

            $userExperiences = Cache::tags([UserExperienceEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserExperienceEnum::DETAIL_LIST_USER_EXPERIENCE_BY_USER_SLUG->value,
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
