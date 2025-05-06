<?php

namespace App\Commands\ProfileSeries\UserCertification\GetListCertificationCurrentUser;

use App\Enums\RouteNames\Profile\UserCertificationEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserCertification\CurrentUserCertificationResource;
use App\Repositories\User\UserRepository;

class GetListCertificationCurrentUserHandle
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
            $cache = redisCacheDB()->tags([UserCertificationEnum::TAG_NAME->value])->has(
                UserCertificationEnum::LIST_CERTIFICATION_CURRENT_USER->value . auth()->user()->id
            );

            $userCertification = redisCacheDB()->tags([UserCertificationEnum::TAG_NAME->value])
                ->remember(
                UserCertificationEnum::LIST_CERTIFICATION_CURRENT_USER->value . auth()->user()->id,
                CacheTTL::REMEMBER->value,
                fn() => $this->userRepository->findWithRelationships
                (
                    auth()->user()->id,
                    'userCertifications.userCertificationResources.contentType',
                    [
                        'userCertifications' => function ($query) {
                            return $query->orderByDesc('id');
                        }
                    ]
                )
            );

            if(empty($userCertification)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => CurrentUserCertificationResource::make($userCertification),
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
