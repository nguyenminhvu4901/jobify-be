<?php

namespace App\Commands\ProfileSeries\UserCertification\GetCompleteListOfUserCertification;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserCertificationEnum;
use App\Http\Resources\ProfileSeries\UserCertification\UserCertificationResource;
use App\Repositories\ProfileSeries\UserCertification\UserCertificationRepository;
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
     * @param GetCompleteListOfUserCertificationCommand $command
     * @return array
     */
    public function handle(GetCompleteListOfUserCertificationCommand $command): array
    {
        try {
            $cache = Cache::tags([UserCertificationEnum::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        UserCertificationEnum::COMPLETE_LIST_USER_CERTIFICATION->value,
                        $command
                    )
                );

            $userCertifications = Cache::tags([UserCertificationEnum::TAG_NAME->value])->remember(
                generateCacheName(
                    UserCertificationEnum::COMPLETE_LIST_USER_CERTIFICATION->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userCertificationRepository->paginateWithRelationship(
                    relationship: ['userCertificationResources.contentType', 'user'],
                    limit:  $command->limit
                )
            );

            return [
                'data' => UserCertificationResource::collection($userCertifications),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache,
                'pagination' => formatPaginationData($userCertifications ?? [])
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
