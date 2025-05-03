<?php

namespace App\Commands\ProfileSeries\UserExperience\GetCompleteListOfUserExperience;

use App\Enums\RouteNames\Profile\UserExperienceEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserExperience\UserExperienceResource;
use App\Repositories\ProfileSeries\UserExperience\UserExperienceRepository;
use Illuminate\Support\Facades\Cache;

class GetCompleteListOfUserExperienceHandler
{
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository
    ) {
    }

    public function handle(GetCompleteListOfUserExperienceCommand $command): array
    {
        try {
            $cache = Cache::tags([UserExperienceEnum::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        UserExperienceEnum::COMPLETE_LIST_USER_EXPERIENCE->value,
                        $command
                    )
                );

            $userExperiences = Cache::tags([UserExperienceEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserExperienceEnum::COMPLETE_LIST_USER_EXPERIENCE->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn () => $this->userExperienceRepository->paginateWithRelationship(
                    relationship: ['userExperienceResource.contentType', 'user'],
                    limit: $command->limit
                )
            );

            return [
                'data' => UserExperienceResource::collection($userExperiences),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache,
                'pagination' => formatPaginationData($userExperiences ?? []),
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e,
            ];
        }
    }
}
