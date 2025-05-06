<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\CompanySeries\CompanyBenefitEnum;
use App\Enums\RouteNames\CompanySeries\CompanyBranchEnum;
use App\Enums\RouteNames\CompanySeries\CompanyProfileEnum;
use App\Enums\RouteNames\JobApplicationSeries\JobApplicationEnum;
use App\Enums\RouteNames\JobSeries\JobListingEnum;
use App\Enums\RouteNames\Profile\UserActivityEnum;
use App\Enums\RouteNames\Profile\UserCertificationEnum;
use App\Enums\RouteNames\Profile\UserCourseEnum;
use App\Enums\RouteNames\Profile\UserEducationEnum;
use App\Enums\RouteNames\Profile\UserExperienceEnum;
use App\Enums\RouteNames\Profile\UserLocationEnum;
use App\Enums\RouteNames\Profile\UserPrizeEnum;
use App\Enums\RouteNames\Profile\UserProductEnum;
use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Enums\RouteNames\Profile\UserProjectEnum;
use App\Enums\RouteNames\Profile\UserSkillEnum;
use App\Observers\BaseObserver;

class UserProfileObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserProfileEnum::TAG_NAME->value,

        CompanyProfileEnum::TAG_NAME->value,
        CompanyBranchEnum::TAG_NAME->value,
        CompanyBenefitEnum::TAG_NAME->value,

        JobListingEnum::TAG_NAME->value,

        JobApplicationEnum::TAG_NAME->value,

        UserActivityEnum::TAG_NAME->value,
        UserCertificationEnum::TAG_NAME->value,
        UserCourseEnum::TAG_NAME->value,
        UserEducationEnum::TAG_NAME->value,
        UserExperienceEnum::TAG_NAME->value,
        UserLocationEnum::TAG_NAME->value,
        UserPrizeEnum::TAG_NAME->value,
        UserProductEnum::TAG_NAME->value,
        UserProjectEnum::TAG_NAME->value,
        UserSkillEnum::TAG_NAME->value
    ];
}
