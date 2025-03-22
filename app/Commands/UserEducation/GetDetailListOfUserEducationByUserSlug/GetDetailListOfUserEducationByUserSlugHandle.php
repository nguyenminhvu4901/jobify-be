<?php

namespace App\Commands\UserEducation\GetDetailListOfUserEducationByUserSlug;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserEducation;
use App\Http\Resources\Profile\UserEducation\UserEducationResource;
use App\Repositories\UserEducation\UserEducationRepository;
use Illuminate\Support\Facades\Cache;

class GetDetailListOfUserEducationByUserSlugHandle
{
    /**
     * @param UserEducationRepository $userEducationRepository
     */
    public function __construct(
        protected UserEducationRepository $userEducationRepository
    )
    {
    }

    /**
     * @param GetDetailListOfUserEducationByUserSlugCommand $command
     * @return array
     */
    public function handle(GetDetailListOfUserEducationByUserSlugCommand $command): array
    {
        try {
            $cache = Cache::tags([UserEducation::TAG_NAME->value])->has(
                generateCacheName(
                    UserEducation::DETAIL_LIST_USER_EDUCATION_BY_USER_SLUG->value,
                    $command
                )
            );

            $userEducation = Cache::tags([UserEducation::TAG_NAME->value])->remember(
                generateCacheName(
                    UserEducation::DETAIL_LIST_USER_EDUCATION_BY_USER_SLUG->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() =>  $this->userEducationRepository->getByRelationshipUserSlug(
                    userSlug: $command->userSlug,
                    relationship: 'user'
                )
            );

            return [
                'data' => UserEducationResource::collection($userEducation),
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
