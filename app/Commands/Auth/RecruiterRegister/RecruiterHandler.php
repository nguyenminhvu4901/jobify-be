<?php

namespace App\Commands\Auth\RecruiterRegister;

use App\Enums\DefaultRole;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\CompanyAddress\CompanyAddressRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;

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
        return DB::transaction(function () use ($command) {
            $recruiter = $this->createRecruiter($command);

            $company = $this->createCompany($command, $recruiter->id);

            $this->createCompanyAddress($command, $company->id);

            return $recruiter;
        });
    }

    private function createRecruiter(RecruiterCommand $command)
    {
        return $this->userRepository->create([
            'full_name' => $command->fullName,
            'email' => $command->email,
            'password' => $command->password,
            'phone_number' => $command->phoneNumber,
            'role' => DefaultRole::RECRUITER
        ]);
    }

    private function createCompany(RecruiterCommand $command, int $userId)
    {
        return $this->companyRepository->create([
            'user_id' => $userId,
            'name' => $command->companyName,
            'company_scale_id' => $command->companyScaleId,
            'gender_id' => $command->genderId,
            'tax_code' => $command->taxCode,
        ]);
    }

    private function createCompanyAddress(RecruiterCommand $command, int $companyId)
    {
        $this->companyAddressRepository->create([
            'company_id' => $companyId,
            'province_id' => $command->province,
            'district_id' => $command->district,
        ]);
    }

}