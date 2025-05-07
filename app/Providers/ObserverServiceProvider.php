<?php

namespace App\Providers;

use App\Entities\CompanySeries\Company\Company;
use App\Entities\CompanySeries\CompanyBenefit\CompanyBenefit;
use App\Entities\CompanySeries\CompanyBranch\CompanyBranch;
use App\Entities\CompanySeries\CompanyBusinessSector\CompanyBusinessSector;
use App\Entities\CompanySeries\CompanyOperationType\CompanyOperationType;
use App\Entities\JobApplicationSeries\JobApplication\JobApplication;
use App\Entities\JobApplicationSeries\JobApplicationStatus\JobApplicationStatus;
use App\Entities\JobSeries\JobContact\JobContact;
use App\Entities\JobSeries\JobListing\JobListing;
use App\Entities\JobSeries\JobListingDetail\JobListingDetail;
use App\Entities\JobSeries\JobLocation\JobLocation;
use App\Entities\JobSeries\JobModerationStatusLog\JobModerationStatusLog;
use App\Entities\JobSeries\JobPosition\JobPosition;
use App\Entities\JobSeries\JobSalary\JobSalary;
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
use App\Observers\JobApplicationSeries\JobApplicationObserver;
use App\Observers\JobSeries\JobListingObserver;
use App\Observers\Profile\UserActivityObserver;
use App\Observers\Profile\UserCertificationObserver;
use App\Observers\Profile\UserCourseObserver;
use App\Observers\Profile\UserEducationObserver;
use App\Observers\Profile\UserExperienceObserver;
use App\Observers\Profile\UserLocationObserver;
use App\Observers\Profile\UserObserver;
use App\Observers\Profile\UserPrizeObserver;
use App\Observers\Profile\UserProductObserver;
use App\Observers\Profile\UserProfileObserver;
use App\Observers\Profile\UserProjectObserver;
use App\Observers\Profile\UserSkillObserver;
use App\Observers\Searchable\CompanySeries\Company\CompanySyncJobListingObserver;
use App\Observers\Searchable\CompanySeries\CompanyBenefit\BenefitSyncJobObserver;
use App\Observers\Searchable\CompanySeries\CompanyBranch\BranchSyncJobObserver;
use App\Observers\Searchable\CompanySeries\CompanyBusinessSector\BusinessSectorSyncJobObserver;
use App\Observers\Searchable\CompanySeries\CompanyOperationType\OperationTypeSyncJobObserver;
use App\Observers\Searchable\JobSeries\JobContact\ContactSyncJobObserver;
use App\Observers\Searchable\JobSeries\JobListingDetail\JobDetailSyncJobObserver;
use App\Observers\Searchable\JobSeries\JobLocation\LocationSyncJobObserver;
use App\Observers\Searchable\JobSeries\JobModerationStatusLog\ModerationStatusLogSyncJobObserver;
use App\Observers\Searchable\JobSeries\JobPosition\PositionSyncJobObserver;
use App\Observers\Searchable\JobSeries\JobSalary\SalarySyncJobObserver;
use App\Services\Observer\ObserverFlag;
use Illuminate\Support\Arr;
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

        Company::class => [
            CompanyObserver::class,
            CompanySyncJobListingObserver::class
        ],

        CompanyBranch::class => [
            CompanyBranchObserver::class,
            BranchSyncJobObserver::class
        ],

        CompanyBenefit::class => [
            CompanyBenefitObserver::class,
            BenefitSyncJobObserver::class
        ],

        CompanyOperationType::class => OperationTypeSyncJobObserver::class,
        CompanyBusinessSector::class => BusinessSectorSyncJobObserver::class,

        JobListing::class => JobListingObserver::class,

        JobLocation::class => LocationSyncJobObserver::class,
        JobSalary::class => SalarySyncJobObserver::class,
        JobPosition::class => PositionSyncJobObserver::class,
        JobContact::class => ContactSyncJobObserver::class,
        JobModerationStatusLog::class => ModerationStatusLogSyncJobObserver::class,
        JobListingDetail::class => JobDetailSyncJobObserver::class,

        JobApplication::class => JobApplicationObserver::class,
        JobApplicationStatus::class => JobApplicationObserver::class,
    ];

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        foreach ($this->observers as $model => $observers) {
            foreach (Arr::flatten(Arr::wrap($observers)) as $observer) {
                $model::observe($observer);
            }
        }
    }

    public function register(): void
    {
        $this->app->scoped(ObserverFlag::class, function () {
            return new ObserverFlag();
        });
    }
}
