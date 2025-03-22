<?php

namespace App\Providers;

use App\Repositories\BusinessSector\BusinessSectorRepository;
use App\Repositories\BusinessSector\BusinessSectorRepositoryEloquent;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryEloquent;
use App\Repositories\CompanyBranch\CompanyBranchRepository;
use App\Repositories\CompanyBranch\CompanyBranchRepositoryEloquent;
use App\Repositories\OperationType\OperationTypeRepository;
use App\Repositories\OperationType\OperationTypeRepositoryEloquent;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryEloquent;
use App\Repositories\UserActivity\UserActivityRepository;
use App\Repositories\UserActivity\UserActivityRepositoryEloquent;
use App\Repositories\UserActivityResource\UserActivityResourceRepository;
use App\Repositories\UserActivityResource\UserActivityResourceRepositoryEloquent;
use App\Repositories\UserCertification\UserCertificationRepository;
use App\Repositories\UserCertification\UserCertificationRepositoryEloquent;
use App\Repositories\UserCertificationResource\UserCertificationResourceRepository;
use App\Repositories\UserCertificationResource\UserCertificationResourceRepositoryEloquent;
use App\Repositories\UserCourse\UserCourseRepository;
use App\Repositories\UserCourse\UserCourseRepositoryEloquent;
use App\Repositories\UserCourseResource\UserCourseResourceRepository;
use App\Repositories\UserCourseResource\UserCourseResourceRepositoryEloquent;
use App\Repositories\UserEducation\UserEducationRepository;
use App\Repositories\UserEducation\UserEducationRepositoryEloquent;
use App\Repositories\UserExperience\UserExperienceRepository;
use App\Repositories\UserExperience\UserExperienceRepositoryEloquent;
use App\Repositories\UserExperienceResource\UserExperienceResourceRepository;
use App\Repositories\UserExperienceResource\UserExperienceResourceRepositoryEloquent;
use App\Repositories\UserLocation\UserLocationRepository;
use App\Repositories\UserLocation\UserLocationRepositoryEloquent;
use App\Repositories\UserPrize\UserPrizeRepository;
use App\Repositories\UserPrize\UserPrizeRepositoryEloquent;
use App\Repositories\UserPrizeResource\UserPrizeResourceRepository;
use App\Repositories\UserPrizeResource\UserPrizeResourceRepositoryEloquent;
use App\Repositories\UserProduct\UserProductRepository;
use App\Repositories\UserProduct\UserProductRepositoryEloquent;
use App\Repositories\UserProductResource\UserProductResourceRepository;
use App\Repositories\UserProductResource\UserProductResourceRepositoryEloquent;
use App\Repositories\UserProfile\UserProfileRepository;
use App\Repositories\UserProfile\UserProfileRepositoryEloquent;
use App\Repositories\UserProject\UserProjectRepository;
use App\Repositories\UserProject\UserProjectRepositoryEloquent;
use App\Repositories\UserProjectResource\UserProjectResourceRepository;
use App\Repositories\UserProjectResource\UserProjectResourceRepositoryEloquent;
use App\Repositories\UserSkill\UserSkillRepository;
use App\Repositories\UserSkill\UserSkillRepositoryEloquent;
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
        BusinessSectorRepository::class => BusinessSectorRepositoryEloquent::class
    ];
}
