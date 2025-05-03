<?php

namespace App\Commands\ProfileSeries\UserProject\GetListProjectCurrentUser;

use App\Enums\RouteNames\Profile\UserProjectEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserProject\CurrentUserProjectResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Cache;

class GetListProjectCurrentUserHandle
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
            $cache = Cache::tags([UserProjectEnum::TAG_NAME->value])->has(
                UserProjectEnum::LIST_PROJECT_CURRENT_USER->value . auth()->user()->id
            );

            $userProjects = Cache::tags([UserProjectEnum::TAG_NAME->value])
                ->remember(
                    UserProjectEnum::LIST_PROJECT_CURRENT_USER->value . auth()->user()->id,
                    CacheTTL::REMEMBER->value,
                    fn() => $this->userRepository->findWithRelationships(
                        auth()->user()->id,
                        'userProjects.userProjectResources.contentType',
                        [
                            'userProjects' => function ($query) {
                                return $query->orderByDesc('id');
                            }
                        ]
                    )
                );

            if(empty($userProjects)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => CurrentUserProjectResource::make($userProjects),
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
