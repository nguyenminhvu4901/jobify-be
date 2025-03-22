<?php

namespace App\Commands\PersonalInfo\GetInformationCVCurrentUser;

use App\Enums\CacheTTL;
use App\Enums\RouteNames\Profile\UserProfile;
use App\Http\Resources\Profile\UserProfile\InformationCVCurrentUserResource;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Cache;

class GetInformationCVCurrentUserHandler
{
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
            $cache = Cache::tags([UserProfile::TAG_NAME->value])
                ->has(
                    UserProfile::INFORMATION_CV_CURRENT_USER->value . auth()?->user()?->id
                );

            $userInfo = Cache::tags([UserProfile::TAG_NAME->value])->remember(
                UserProfile::INFORMATION_CV_CURRENT_USER->value . auth()?->user()?->id,
                CacheTTL::REMEMBER->value,
                fn() => $this->userRepository->findWithRelationships(
                    auth()?->user()?->id,
                    [
                        'userProfile.gender', 'userExperiences.userExperienceResource.contentType',
                        'userCertifications.userCertificationResources.contentType',
                        'userEducations', 'userSkills.rate', 'userCourses.userCourseResources.contentType',
                        'userProjects.userProjectResources.contentType', 'userPrizes.userPrizeResources.contentType',
                        'userProducts.userProductResources.contentType', 'userActivities.userActivityResources.contentType',
                        'userLocations.province', 'userLocations.district', 'userLocations.ward', 'status'
                    ]
                )
            );

            if(!empty($userInfo)){
                return [
                    'data' => InformationCVCurrentUserResource::make($userInfo),
                    'message' => __('messages.profile.user_get_profile_success'),
                    'cache' => $cache,
                ];
            }

            return [
                'message' => __('messages.profile.user_get_profile_error'),
            ];
        }catch (\Exception $e){
            return [
                'message' => __('messages.profile.user_get_profile_error'),
                'error' => $e
            ];
        }
    }
}
