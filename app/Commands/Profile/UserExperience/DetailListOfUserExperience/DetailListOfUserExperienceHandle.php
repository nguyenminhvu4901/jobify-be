<?php

namespace App\Commands\Profile\UserExperience\DetailListOfUserExperience;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserExperience;
use App\Http\Resources\Profile\UserExperience\UserExperienceResource;
use App\Repositories\UserExperience\UserExperienceRepository;
use Illuminate\Support\Facades\Cache;

class DetailListOfUserExperienceHandle
{
    public function __construct(
        protected UserExperienceRepository $userExperienceRepository
    )
    {
    }

    public function handle(DetailListOfUserExperienceCommand $command): array
    {
        try {
            $cache = Cache::tags([UserExperience::TAG_NAME->value])->has(
                generateCacheName(
                    UserExperience::DETAIL_LIST_USER_EXPERIENCE->value,
                    $command
                )
            );

            $userExperience = Cache::tags([UserExperience::TAG_NAME->value])->remember(
                generateCacheName(
                    UserExperience::DETAIL_LIST_USER_EXPERIENCE->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userExperienceRepository->findWithRelationships(
                    id: $command->userExperienceId,
                    relationship: ['user', 'userExperienceResource.contentType']
                )
            );

            if(empty($userExperience)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => UserExperienceResource::make($userExperience),
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
