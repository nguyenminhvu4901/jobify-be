<?php

namespace App\Commands\UserCertification\GetCompleteListOfUserCertification;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserCertification;
use App\Http\Resources\UserCertification\UserCertificationResource;
use App\Repositories\UserCertification\UserCertificationRepository;
use Illuminate\Support\Facades\Cache;

class GetCompleteListOfUserCertificationHandle
{
    /**
     * @param UserCertificationRepository $userCertificationRepository
     */
    public function __construct(
        protected UserCertificationRepository $userCertificationRepository
    )
    {
    }

    /**
     * @return array
     */
    public function handle(): array
    {
        try {
            $cache = Cache::tags([UserCertification::TAG_NAME->value])
                ->has(UserCertification::COMPLETE_LIST_USER_CERTIFICATION->value);

            $userCertifications = Cache::tags([UserCertification::TAG_NAME->value])->remember(
                UserCertification::COMPLETE_LIST_USER_CERTIFICATION->value,
                CacheTTL::REMEMBER->value,
                fn() => $this->userCertificationRepository->getWithRelationship(
                    ['userCertificationResources.contentType', 'user']
                )
            );


            return [
                'data' => UserCertificationResource::collection($userCertifications),
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
