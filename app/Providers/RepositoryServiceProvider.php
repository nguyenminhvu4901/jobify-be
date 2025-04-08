<?php

namespace App\Providers;

use App\Repositories\CompanySeries\BusinessSector\BusinessSectorRepository;
use App\Repositories\CompanySeries\BusinessSector\BusinessSectorRepositoryEloquent;
use App\Repositories\CompanySeries\Company\CompanyRepository;
use App\Repositories\CompanySeries\Company\CompanyRepositoryEloquent;
use App\Repositories\CompanySeries\CompanyBenefit\CompanyBenefitRepository;
use App\Repositories\CompanySeries\CompanyBenefit\CompanyBenefitRepositoryEloquent;
use App\Repositories\CompanySeries\CompanyBranch\CompanyBranchRepository;
use App\Repositories\CompanySeries\CompanyBranch\CompanyBranchRepositoryEloquent;
use App\Repositories\CompanySeries\CompanyScale\CompanyScaleRepository;
use App\Repositories\CompanySeries\CompanyScale\CompanyScaleRepositoryEloquent;
use App\Repositories\CompanySeries\CompanyWorkingDay\CompanyWorkingDayRepository;
use App\Repositories\CompanySeries\CompanyWorkingDay\CompanyWorkingDayRepositoryEloquent;
use App\Repositories\CompanySeries\OperationType\OperationTypeRepository;
use App\Repositories\CompanySeries\OperationType\OperationTypeRepositoryEloquent;
use App\Repositories\ProfileSeries\UserActivity\UserActivityRepository;
use App\Repositories\ProfileSeries\UserActivity\UserActivityRepositoryEloquent;
use App\Repositories\ProfileSeries\UserActivityResource\UserActivityResourceRepository;
use App\Repositories\ProfileSeries\UserActivityResource\UserActivityResourceRepositoryEloquent;
use App\Repositories\ProfileSeries\UserCertification\UserCertificationRepository;
use App\Repositories\ProfileSeries\UserCertification\UserCertificationRepositoryEloquent;
use App\Repositories\ProfileSeries\UserCertificationResource\UserCertificationResourceRepository;
use App\Repositories\ProfileSeries\UserCertificationResource\UserCertificationResourceRepositoryEloquent;
use App\Repositories\ProfileSeries\UserCourse\UserCourseRepository;
use App\Repositories\ProfileSeries\UserCourse\UserCourseRepositoryEloquent;
use App\Repositories\ProfileSeries\UserCourseResource\UserCourseResourceRepository;
use App\Repositories\ProfileSeries\UserCourseResource\UserCourseResourceRepositoryEloquent;
use App\Repositories\ProfileSeries\UserEducation\UserEducationRepository;
use App\Repositories\ProfileSeries\UserEducation\UserEducationRepositoryEloquent;
use App\Repositories\ProfileSeries\UserExperience\UserExperienceRepository;
use App\Repositories\ProfileSeries\UserExperience\UserExperienceRepositoryEloquent;
use App\Repositories\ProfileSeries\UserExperienceResource\UserExperienceResourceRepository;
use App\Repositories\ProfileSeries\UserExperienceResource\UserExperienceResourceRepositoryEloquent;
use App\Repositories\ProfileSeries\UserLocation\UserLocationRepository;
use App\Repositories\ProfileSeries\UserLocation\UserLocationRepositoryEloquent;
use App\Repositories\ProfileSeries\UserPrize\UserPrizeRepository;
use App\Repositories\ProfileSeries\UserPrize\UserPrizeRepositoryEloquent;
use App\Repositories\ProfileSeries\UserPrizeResource\UserPrizeResourceRepository;
use App\Repositories\ProfileSeries\UserPrizeResource\UserPrizeResourceRepositoryEloquent;
use App\Repositories\ProfileSeries\UserProduct\UserProductRepository;
use App\Repositories\ProfileSeries\UserProduct\UserProductRepositoryEloquent;
use App\Repositories\ProfileSeries\UserProductResource\UserProductResourceRepository;
use App\Repositories\ProfileSeries\UserProductResource\UserProductResourceRepositoryEloquent;
use App\Repositories\ProfileSeries\UserProfile\UserProfileRepository;
use App\Repositories\ProfileSeries\UserProfile\UserProfileRepositoryEloquent;
use App\Repositories\ProfileSeries\UserProject\UserProjectRepository;
use App\Repositories\ProfileSeries\UserProject\UserProjectRepositoryEloquent;
use App\Repositories\ProfileSeries\UserProjectResource\UserProjectResourceRepository;
use App\Repositories\ProfileSeries\UserProjectResource\UserProjectResourceRepositoryEloquent;
use App\Repositories\ProfileSeries\UserSkill\UserSkillRepository;
use App\Repositories\ProfileSeries\UserSkill\UserSkillRepositoryEloquent;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public $singletons = [
        UserRepository::class => UserRepositoryEloquent::class,
        CompanyRepository::class => CompanyRepositoryEloquent::class,
        CompanyBranchRepository::class => CompanyBranchRepositoryEloquent::class,
        UserProfileRepository::class => UserProfileRepositoryEloquent::class,
        UserExperienceRepository::class => UserExperienceRepositoryEloquent::class,
        UserExperienceResourceRepository::class => UserExperienceResourceRepositoryEloquent::class,
        UserCertificationRepository::class => UserCertificationRepositoryEloquent::class,
        UserCertificationResourceRepository::class => UserCertificationResourceRepositoryEloquent::class,
        UserEducationRepository::class => UserEducationRepositoryEloquent::class,
        UserSkillRepository::class => UserSkillRepositoryEloquent::class,
        UserCourseRepository::class => UserCourseRepositoryEloquent::class,
        UserCourseResourceRepository::class => UserCourseResourceRepositoryEloquent::class,
        UserProjectRepository::class => UserProjectRepositoryEloquent::class,
        UserProjectResourceRepository::class => UserProjectResourceRepositoryEloquent::class,
        UserPrizeRepository::class => UserPrizeRepositoryEloquent::class,
        UserPrizeResourceRepository::class => UserPrizeResourceRepositoryEloquent::class,
        UserProductRepository::class => UserProductRepositoryEloquent::class,
        UserProductResourceRepository::class => UserProductResourceRepositoryEloquent::class,
        UserActivityRepository::class => UserActivityRepositoryEloquent::class,
        UserActivityResourceRepository::class => UserActivityResourceRepositoryEloquent::class,
        UserLocationRepository::class => UserLocationRepositoryEloquent::class,
        OperationTypeRepository::class => OperationTypeRepositoryEloquent::class,
        BusinessSectorRepository::class => BusinessSectorRepositoryEloquent::class,
        CompanyWorkingDayRepository::class => CompanyWorkingDayRepositoryEloquent::class,
        CompanyScaleRepository::class => CompanyScaleRepositoryEloquent::class,
        CompanyBenefitRepository::class => CompanyBenefitRepositoryEloquent::class
    ];
}
