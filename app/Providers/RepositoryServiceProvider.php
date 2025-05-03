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
use App\Repositories\JobApplicationSeries\ApplicationCV\ApplicationCVRepository;
use App\Repositories\JobApplicationSeries\ApplicationCV\ApplicationCVRepositoryEloquent;
use App\Repositories\JobApplicationSeries\ApplicationStatus\ApplicationStatusRepository;
use App\Repositories\JobApplicationSeries\ApplicationStatus\ApplicationStatusRepositoryEloquent;
use App\Repositories\JobApplicationSeries\JobApplication\JobApplicationRepository;
use App\Repositories\JobApplicationSeries\JobApplication\JobApplicationRepositoryEloquent;
use App\Repositories\JobApplicationSeries\JobApplicationStatus\JobApplicationStatusRepository;
use App\Repositories\JobApplicationSeries\JobApplicationStatus\JobApplicationStatusRepositoryEloquent;
use App\Repositories\JobSeries\Currency\CurrencyRepository;
use App\Repositories\JobSeries\Currency\CurrencyRepositoryEloquent;
use App\Repositories\JobSeries\JobAgeRange\JobAgeRangeRepository;
use App\Repositories\JobSeries\JobAgeRange\JobAgeRangeRepositoryEloquent;
use App\Repositories\JobSeries\JobContact\JobContactRepository;
use App\Repositories\JobSeries\JobContact\JobContactRepositoryEloquent;
use App\Repositories\JobSeries\JobEducationLevel\JobEducationLevelRepository;
use App\Repositories\JobSeries\JobEducationLevel\JobEducationLevelRepositoryEloquent;
use App\Repositories\JobSeries\JobExperience\JobExperienceRepository;
use App\Repositories\JobSeries\JobExperience\JobExperienceRepositoryEloquent;
use App\Repositories\JobSeries\JobLevel\JobLevelRepository;
use App\Repositories\JobSeries\JobLevel\JobLevelRepositoryEloquent;
use App\Repositories\JobSeries\JobListing\JobListingRepository;
use App\Repositories\JobSeries\JobListing\JobListingRepositoryEloquent;
use App\Repositories\JobSeries\JobListingDetail\JobListingDetailRepository;
use App\Repositories\JobSeries\JobListingDetail\JobListingDetailRepositoryEloquent;
use App\Repositories\JobSeries\JobLocation\JobLocationRepository;
use App\Repositories\JobSeries\JobLocation\JobLocationRepositoryEloquent;
use App\Repositories\JobSeries\JobModerationStatus\JobModerationStatusRepository;
use App\Repositories\JobSeries\JobModerationStatus\JobModerationStatusRepositoryEloquent;
use App\Repositories\JobSeries\JobPosition\JobPositionRepository;
use App\Repositories\JobSeries\JobPosition\JobPositionRepositoryEloquent;
use App\Repositories\JobSeries\JobSalary\JobSalaryRepository;
use App\Repositories\JobSeries\JobSalary\JobSalaryRepositoryEloquent;
use App\Repositories\JobSeries\JobSalaryType\JobSalaryTypeRepository;
use App\Repositories\JobSeries\JobSalaryType\JobSalaryTypeRepositoryEloquent;
use App\Repositories\JobSeries\JobType\JobTypeRepository;
use App\Repositories\JobSeries\JobType\JobTypeRepositoryEloquent;
use App\Repositories\JobSeries\JobVisibilityStatus\JobVisibilityStatusRepository;
use App\Repositories\JobSeries\JobVisibilityStatus\JobVisibilityStatusRepositoryEloquent;
use App\Repositories\JobSeries\Position\PositionRepository;
use App\Repositories\JobSeries\Position\PositionRepositoryEloquent;
use App\Repositories\JobSeries\Salary\SalaryRepository;
use App\Repositories\JobSeries\Salary\SalaryRepositoryEloquent;
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
        CompanyBenefitRepository::class => CompanyBenefitRepositoryEloquent::class,
        JobAgeRangeRepository::class => JobAgeRangeRepositoryEloquent::class,
        JobTypeRepository::class => JobTypeRepositoryEloquent::class,
        JobLevelRepository::class => JobLevelRepositoryEloquent::class,
        JobExperienceRepository::class => JobExperienceRepositoryEloquent::class,
        JobEducationLevelRepository::class => JobEducationLevelRepositoryEloquent::class,
        PositionRepository::class => PositionRepositoryEloquent::class,
        CurrencyRepository::class => CurrencyRepositoryEloquent::class,
        JobSalaryTypeRepository::class => JobSalaryTypeRepositoryEloquent::class,
        JobListingRepository::class => JobListingRepositoryEloquent::class,
        JobModerationStatusRepository::class => JobModerationStatusRepositoryEloquent::class,
        JobVisibilityStatusRepository::class => JobVisibilityStatusRepositoryEloquent::class,
        JobSalaryRepository::class => JobSalaryRepositoryEloquent::class,
        JobLocationRepository::class => JobLocationRepositoryEloquent::class,
        JobPositionRepository::class => JobPositionRepositoryEloquent::class,
        JobContactRepository::class => JobContactRepositoryEloquent::class,
        JobListingDetailRepository::class => JobListingDetailRepositoryEloquent::class,
        SalaryRepository::class => SalaryRepositoryEloquent::class,
        JobApplicationRepository::class => JobApplicationRepositoryEloquent::class,
        ApplicationStatusRepository::class => ApplicationStatusRepositoryEloquent::class,
        JobApplicationStatusRepository::class => JobApplicationStatusRepositoryEloquent::class,
        ApplicationCVRepository::class => ApplicationCVRepositoryEloquent::class,
    ];
}
