<?php

namespace App\Providers;

use App\Entities\UserActivity\UserActivity;
use App\Entities\UserCertification\UserCertification;
use App\Entities\UserCourse\UserCourse;
use App\Entities\UserEducation\UserEducation;
use App\Entities\UserExperience\UserExperience;
use App\Entities\UserLocation\UserLocation;
use App\Entities\UserPrize\UserPrize;
use App\Entities\UserProduct\UserProduct;
use App\Entities\UserProfile\UserProfile;
use App\Entities\UserProject\UserProject;
use App\Entities\UserSkill\UserSkill;
use App\Models\User;
use App\Observers\Profile\UserActivityObserver;
use App\Observers\Profile\UserCertificationObserver;
use App\Observers\Profile\UserCourseObserver;
use App\Observers\Profile\UserEducationObserver;
use App\Observers\Profile\UserExperienceObserver;
use App\Observers\Profile\UserLocationObserver;
use App\Observers\Profile\UserPrizeObserver;
use App\Observers\Profile\UserProductObserver;
use App\Observers\Profile\UserProfileObserver;
use App\Observers\Profile\UserProjectObserver;
use App\Observers\Profile\UserSkillObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    protected array $observers = [
        User::class => UserObserver::class,
        UserActivity::class => UserActivityObserver::class,
        UserCertification::class => UserCertificationObserver::class,
        UserCourse::class => UserCourseObserver::class,
        UserEducation::class => UserEducationObserver::class,
        UserExperience::class => UserExperienceObserver::class,
        UserPrize::class => UserPrizeObserver::class,
        UserProduct::class => UserProductObserver::class,
        UserProject::class => UserProjectObserver::class,
        UserSkill::class => UserSkillObserver::class,
        UserLocation::class => UserLocationObserver::class,
        UserProfile::class => UserProfileObserver::class,
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        foreach ($this->observers as $model => $observer) {
            $model::observe($observer);
        }
    }
}
