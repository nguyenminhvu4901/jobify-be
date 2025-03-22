<?php

namespace App\Commands\Profile\UserCertification\GetDetailListOfUserCertification;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserCertification;
use App\Http\Resources\Profile\UserCertification\UserCertificationResource;
use App\Repositories\UserCertification\UserCertificationRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserCertificationHandle
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
     * @param GetDetailListOfUserCertificationCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserCertificationCommand $command): array
    {
        try {
            $cache = Cache::tags([UserCertification::TAG_NAME->value])->has(
                generateCacheName(
                    UserCertification::DETAIL_LIST_USER_CERTIFICATION->value,
                    $command
                ));

            $userCertification = Cache::tags([UserCertification::TAG_NAME->value])
                ->remember(
                    generateCacheName(
                        UserCertification::DETAIL_LIST_USER_CERTIFICATION->value,
                        $command
                    ),
                    CacheTTL::REMEMBER->value,
                    fn() => $this->userCertificationRepository->findWithRelationships(
                            $command->userCertificationId,
                            ['user', 'userCertificationResources.contentType']
                    )
                );

            if(empty($userCertification)){
                return [
                    'message' => __('messages.profile.user_get_profile_error')
                ];
            }

            return [
                'data' => UserCertificationResource::make($userCertification),
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
