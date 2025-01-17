<?php

namespace App\Providers;

use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryEloquent;
use App\Repositories\CompanyAddress\CompanyAddressRepository;
use App\Repositories\CompanyAddress\CompanyAddressRepositoryEloquent;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryEloquent;
use App\Repositories\UserCertification\UserCertificationRepository;
use App\Repositories\UserCertification\UserCertificationRepositoryEloquent;
use App\Repositories\UserCertificationResource\UserCertificationResourceRepository;
use App\Repositories\UserCertificationResource\UserCertificationResourceRepositoryEloquent;
use App\Repositories\UserExperience\UserExperienceRepository;
use App\Repositories\UserExperience\UserExperienceRepositoryEloquent;
use App\Repositories\UserExperienceResource\UserExperienceResourceRepository;
use App\Repositories\UserExperienceResource\UserExperienceResourceRepositoryEloquent;
use App\Repositories\UserProfile\UserProfileRepository;
use App\Repositories\UserProfile\UserProfileRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public $singletons = [
        UserRepository::class => UserRepositoryEloquent::class,
        CompanyRepository::class => CompanyRepositoryEloquent::class,
        CompanyAddressRepository::class => CompanyAddressRepositoryEloquent::class,
        UserProfileRepository::class => UserProfileRepositoryEloquent::class,
        UserExperienceRepository::class => UserExperienceRepositoryEloquent::class,
        UserExperienceResourceRepository::class => UserExperienceResourceRepositoryEloquent::class,
        UserCertificationRepository::class => UserCertificationRepositoryEloquent::class,
        UserCertificationResourceRepository::class => UserCertificationResourceRepositoryEloquent::class
    ];
}
