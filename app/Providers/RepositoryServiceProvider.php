<?php

namespace App\Providers;

use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryEloquent;
use App\Repositories\CompanyAddress\CompanyAddressRepository;
use App\Repositories\CompanyAddress\CompanyAddressRepositoryEloquent;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryEloquent;
use App\Repositories\UserProfile\UserProfileRepository;
use App\Repositories\UserProfile\UserProfileRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public $singletons = [
        UserRepository::class => UserRepositoryEloquent::class,
        CompanyRepository::class => CompanyRepositoryEloquent::class,
        CompanyAddressRepository::class => CompanyAddressRepositoryEloquent::class,
        UserProfileRepository::class => UserProfileRepositoryEloquent::class
    ];
}
