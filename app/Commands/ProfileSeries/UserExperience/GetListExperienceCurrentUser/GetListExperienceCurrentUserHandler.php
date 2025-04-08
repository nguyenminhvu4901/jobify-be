<?php

namespace App\Commands\ProfileSeries\UserExperience\GetListExperienceCurrentUser;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserExperienceEnum;
use App\Http\Resources\ProfileSeries\UserExperience\CurrentUserExperienceResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Cache;

class GetListExperienceCurrentUserHandler
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        protected UserRepository $userRepository
    )
    {}

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $cache = Cache::tags([UserExperienceEnum::TAG_NAME->value])->has(
                UserExperienceEnum::LIST_EXPERIENCE_CURRENT_USER->value . auth()->user()->id
            );

            $userExperience = Cache::tags([UserExperienceEnum::TAG_NAME->value])
                ->remember(
                    UserExperienceEnum::LIST_EXPERIENCE_CURRENT_USER->value . auth()->user()->id,
                    CacheTTL::REMEMBER->value,
                    fn() => $this->userRepository->findWithRelationships(
                        auth()->user()->id,
                        'userExperiences.userExperienceResource.contentType',
                        [
                            'userExperiences' => function ($query) {
                                return $query->orderByDesc('id');
                            }
                        ]
                    )
                );

            if(empty($userExperience)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => CurrentUserExperienceResource::make($userExperience),
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
