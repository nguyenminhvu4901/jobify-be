<?php

namespace App\Commands\UserCertification\GetDetailListOfUserCertificationByUserSlug;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserCertification;
use App\Http\Resources\UserCertification\UserCertificationResource;
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
                UserCertification::DETAIL_LIST_USER_CERTIFICATION_BY_USER_SLUG->value . $command->userSlug);

            $userCertifications = Cache::tags([UserCertification::TAG_NAME->value])->remember(
                UserCertification::DETAIL_LIST_USER_CERTIFICATION_BY_USER_SLUG->value . $command->userSlug,
                CacheTTL::REMEMBER->value, function () use($command) {
                    return $this->userCertificationRepository->getByRelationshipUserSlug(
                        $command->userSlug,
                        ['userCertificationResources.contentType', 'user']
                    );
            });

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
