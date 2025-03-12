<?php

namespace App\Commands\UserEducation\GetListEducationCurrentUser;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserEducation;
use App\Http\Resources\UserEducation\CurrentUserEducationResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Cache;

class GetListEducationCurrentUserHandle
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
            $cache = Cache::tags([UserEducation::TAG_NAME->value])->has(
                UserEducation::LIST_EDUCATION_CURRENT_USER->value . auth()->user()->id
            );

            $userEducation = Cache::tags([UserEducation::TAG_NAME->value])
                ->remember(
                    UserEducation::LIST_EDUCATION_CURRENT_USER->value . auth()->user()->id,
                    CacheTTL::REMEMBER->value,
                    fn() => $this->userRepository->findWithRelationships(
                        id: auth()->user()->id,
                        relationship: 'userEducations',
                        relationshipCallbacksToFilter: [
                            'userEducations' => function ($query) {
                                return $query->orderByDesc('id');
                            }
                        ]
                    )
                );

            if(empty($userEducation)){

                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => CurrentUserEducationResource::make($userEducation),
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
