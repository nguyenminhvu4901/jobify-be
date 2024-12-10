<?php

namespace App\Commands\Auth\RecruiterRegister;

use App\Enums\DefaultRole;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\CompanyAddress\CompanyAddressRepository;
use App\Repositories\User\UserRepository;

class RecruiterHandler
{
    public function __construct(
        protected readonly UserRepository $userRepository,
        protected readonly CompanyRepository $companyRepository,
        protected readonly CompanyAddressRepository $companyAddressRepository
    )
    {
    }

    public function handle(RecruiterCommand $command)
    {
        $recruiter = $this->userRepository->create([
            'full_name' => $command->fullName,
            'email' => $command->email,
            'password' => $command->password,
            'phone_number' => $command->phoneNumber,
            'role' => DefaultRole::RECRUITER
        ]);

        $company = $this->companyRepository->create([
            'user_id' => $recruiter->id,
            'name' => $command->companyName,
            'company_scale_id' => $command->companyScaleId,
            'gender_id' => $command->genderId,
            'tax_code' => $command->taxCode
        ]);

        $this->companyAddressRepository->create([
            'company_id' => $company->id,
            'province_id' => $command->province,
            'district_id' => $command->district,
        ]);

        return $recruiter;
    }
}
