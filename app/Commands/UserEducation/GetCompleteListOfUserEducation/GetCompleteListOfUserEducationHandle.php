<?php

namespace App\Commands\UserEducation\GetCompleteListOfUserEducation;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserEducation;
use App\Helpers\Global\PaginationHelper;
use App\Http\Resources\Profile\UserEducation\UserEducationResource;
use App\Repositories\UserEducation\UserEducationRepository;
use Illuminate\Support\Facades\Cache;

class GetCompleteListOfUserEducationHandle
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
     * @param GetCompleteListOfUserEducationCommand $command
     * @return array
     */
    public function handle(GetCompleteListOfUserEducationCommand $command): array
    {
        try {
            $cache = Cache::tags([UserEducation::TAG_NAME->value])
                ->has(
                    generateCacheName(
                        UserEducation::COMPLETE_LIST_USER_EDUCATION->value,
                        $command
                    )
                );

            $userEducation = Cache::tags([UserEducation::TAG_NAME->value])->remember(
                generateCacheName(
                    UserEducation::COMPLETE_LIST_USER_EDUCATION->value,
                    $command
                ),
                CacheTTL::REMEMBER->value,
                fn() => $this->userEducationRepository->paginateWithRelationship(
                    relationship: ['user'],
                    limit: $command->limit
                )
            );

            return [
                'data' => UserEducationResource::collection($userEducation),
                'message' => __('messages.profile.user_get_profile_success'),
                'cache' => $cache,
                'pagination' => PaginationHelper::formatPaginationData($userEducation) ?? []
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }

    }
}
