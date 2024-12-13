<?php

namespace App\Commands\Auth\RecruiterRegister;

use App\Enums\DefaultRole;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\CompanyAddress\CompanyAddressRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\DB;

class RecruiterHandler
{
    /**
     * @param UserRepository $userRepository
     * @param CompanyRepository $companyRepository
     * @param CompanyAddressRepository $companyAddressRepository
     */
    public function __construct(
        protected readonly UserRepository $userRepository,
        protected readonly CompanyRepository $companyRepository,
        protected readonly CompanyAddressRepository $companyAddressRepository
    )
    {
    }

    /**
     * @param RecruiterCommand $command
     * @return mixed
     */
    public function handle(RecruiterCommand $command): mixed
    {
        return DB::transaction(function () use ($command) {
            $recruiter = $this->createRecruiter($command);

            $company = $this->createCompany($command, $recruiter->id);

            $this->createCompanyAddress($command, $company->id);

            return $recruiter;
        });
    }

    /**
     * @param RecruiterCommand $command
     * @return mixed
     */
    private function createRecruiter(RecruiterCommand $command): mixed
    {
        return $this->userRepository->create([
            'full_name' => $command->fullName,
            'email' => $command->email,
            'password' => $command->password,
            'phone_number' => $command->phoneNumber,
            'current_role' => DefaultRole::RECRUITER,
            'role' => DefaultRole::RECRUITER
        ]);
    }

    /**
     * @param RecruiterCommand $command
     * @param int $userId
     * @return mixed
     */
    private function createCompany(RecruiterCommand $command, int $userId): mixed
    {
        return $this->companyRepository->create([
            'user_id' => $userId,
            'name' => $command->companyName,
            'company_scale_id' => $command->companyScaleId,
            'gender_id' => $command->genderId,
            'tax_code' => $command->taxCode,
        ]);
    }

    /**
     * @param RecruiterCommand $command
     * @param int $companyId
     * @return void
     */
    private function createCompanyAddress(RecruiterCommand $command, int $companyId): void
    {
        $this->companyAddressRepository->create([
            'company_id' => $companyId,
            'province_id' => $command->province,
            'district_id' => $command->district,
        ]);
    }

}
