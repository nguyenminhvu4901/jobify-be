<?php

namespace App\Commands\ProfileSeries\UserCertification\GetDetailListOfUserCertificationByUserSlug;

use App\Enums\RouteNames\Profile\UserCertificationEnum;
use App\Enums\TTL\CacheTTL;
use App\Http\Resources\ProfileSeries\UserCertification\UserCertificationResource;
use App\Repositories\ProfileSeries\UserCertification\UserCertificationRepository;
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
            $cache = Cache::tags([UserCertificationEnum::TAG_NAME->value])->has(
                generateCacheName(
                    UserCertificationEnum::DETAIL_LIST_USER_CERTIFICATION_BY_USER_SLUG->value,
                    $command
                ));

            $userCertifications = Cache::tags([UserCertificationEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserCertificationEnum::DETAIL_LIST_USER_CERTIFICATION_BY_USER_SLUG->value,
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
