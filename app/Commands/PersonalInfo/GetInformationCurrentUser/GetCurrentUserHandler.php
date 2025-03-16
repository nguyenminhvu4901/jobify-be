<?php

namespace App\Commands\PersonalInfo\GetInformationCurrentUser;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserProfile;
use App\Http\Resources\Auth\CurrentUserInfoResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Cache;

class GetCurrentUserHandler
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
            $cache = Cache::tags([UserProfile::TAG_NAME->value])
                ->has(
                    UserProfile::INFORMATION_CURRENT_USER->value . auth()?->user()?->id
                );

            $userProfile = Cache::tags([UserProfile::TAG_NAME->value])->remember(
                UserProfile::INFORMATION_CURRENT_USER->value . auth()?->user()?->id,
                CacheTTL::REMEMBER->value,
                fn() => $this->userRepository->findWithRelationships(
                    auth()?->user()?->id,
                    [
                        'userProfile.gender', 'status'
                    ]
                )
            );

            if(!empty($userProfile)){
                return [
                    'data' => CurrentUserInfoResource::make($userProfile),
                    'message' => __('messages.profile.user_get_profile_success'),
                    'cache' => $cache,
                ];
            }

            return [
                'message' => __('messages.profile.user_get_profile_error'),
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
