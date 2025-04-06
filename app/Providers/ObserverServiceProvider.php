<?php

namespace App\Providers;

use App\Entities\CompanySeries\Company\Company;
use App\Entities\CompanySeries\CompanyBenefit\CompanyBenefit;
use App\Entities\CompanySeries\CompanyBranch\CompanyBranch;
use App\Entities\ProfileSeries\UserActivity\UserActivity;
use App\Entities\ProfileSeries\UserCertification\UserCertification;
use App\Entities\ProfileSeries\UserCourse\UserCourse;
use App\Entities\ProfileSeries\UserEducation\UserEducation;
use App\Entities\ProfileSeries\UserExperience\UserExperience;
use App\Entities\ProfileSeries\UserLocation\UserLocation;
use App\Entities\ProfileSeries\UserPrize\UserPrize;
use App\Entities\ProfileSeries\UserProduct\UserProduct;
use App\Entities\ProfileSeries\UserProfile\UserProfile;
use App\Entities\ProfileSeries\UserProject\UserProject;
use App\Entities\ProfileSeries\UserSkill\UserSkill;
use App\Models\User;
use App\Observers\Company\CompanyBenefitObserver;
use App\Observers\Company\CompanyBranchObserver;
use App\Observers\Company\CompanyObserver;
use App\Observers\Profile\UserActivityObserver;
use App\Observers\Profile\UserCertificationObserver;
use App\Observers\Profile\UserCourseObserver;
use App\Observers\Profile\UserEducationObserver;
use App\Observers\Profile\UserExperienceObserver;
use App\Observers\Profile\UserLocationObserver;
use App\Observers\Profile\UserPrizeObserver;
use App\Observers\Profile\UserProductObserver;
use App\Observers\Profile\UserObserver;
use App\Observers\Profile\UserProjectObserver;
use App\Observers\Profile\UserSkillObserver;
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
        UserProfile::class => UserObserver::class,
        Company::class => CompanyObserver::class,
        CompanyBranch::class => CompanyBranchObserver::class,
        CompanyBenefit::class => CompanyBenefitObserver::class
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
