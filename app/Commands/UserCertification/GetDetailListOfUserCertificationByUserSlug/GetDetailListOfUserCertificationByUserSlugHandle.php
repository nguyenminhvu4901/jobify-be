<?php

namespace App\Commands\UserCertification\GetDetailListOfUserCertificationByUserSlug;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserCertification;
use App\Http\Resources\Profile\UserCertification\UserCertificationResource;
use App\Repositories\UserCertification\UserCertificationRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserCertificationByUserSlugHandle
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
     * @param GetDetailListOfUserCertificationByUserSlugCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserCertificationByUserSlugCommand $command): array
    {
        try {
            $cache = Cache::tags([UserCertification::TAG_NAME->value])->has(
                generateCacheName(
                    UserCertification::DETAIL_LIST_USER_CERTIFICATION_BY_USER_SLUG->value,
                    $command
                ));

            $userCertifications = Cache::tags([UserCertification::TAG_NAME->value])->remember(
                generateCacheName(
                    UserCertification::DETAIL_LIST_USER_CERTIFICATION_BY_USER_SLUG->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userCertificationRepository->getByRelationshipUserSlug(
                        $command->userSlug,
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
