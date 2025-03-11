<?php

namespace App\Commands\UserCertification\GetListCertificationCurrentUser;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserCertification;
use App\Http\Resources\UserCertification\CurrentUserCertificationResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

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
            $cache = Cache::tags([UserCertification::TAG_NAME->value])->has(
                UserCertification::LIST_CERTIFICATION_CURRENT_USER->value . auth()->user()->id);

            $userCertification = Cache::tags([UserCertification::TAG_NAME->value])
                ->remember(
                UserCertification::LIST_CERTIFICATION_CURRENT_USER->value . auth()->user()->id,
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
