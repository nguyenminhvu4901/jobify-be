<?php

namespace App\Commands\Auth\RecruiterRegister;

use App\Enums\DefaultRole;
use App\Repositories\Company\CompanyRepository;
use App\Repositories\CompanyAddress\CompanyAddressRepository;
use App\Repositories\User\UserRepository;

class RecruiterRegisterHandler
{
    /**
     * @param UserRepository $userRepository
     * @param CompanyRepository $companyRepository
     * @param CompanyAddressRepository $companyAddressRepository
     */
    public function __construct(
        protected UserRepository $userRepository,
        protected CompanyRepository $companyRepository,
        protected CompanyAddressRepository $companyAddressRepository
    )
    {
    }

    /**
     * @param RecruiterRegisterCommand $command
     * @return array
     */
    public function handle(RecruiterRegisterCommand $command): array
    {
        $recruiter = $this->createRecruiter($command);

        if(!empty($recruiter)){
            return [
                'recruiter' => $recruiter,
                'message' => __('messages.authentication.user_register_success')
            ];
        }

        $company = $this->createCompany($command, $recruiter->id);

        $this->createCompanyAddress($command, $company->id);

        return [
            'message' => __('messages.authentication.user_register_error')
        ];
    }

    /**
     * @param RecruiterRegisterCommand $command
     * @return mixed
     */
    private function createRecruiter(RecruiterRegisterCommand $command): mixed
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
     * @param RecruiterRegisterCommand $command
     * @param int $userId
     * @return mixed
     */
    private function createCompany(RecruiterRegisterCommand $command, int $userId): mixed
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
     * @param RecruiterRegisterCommand $command
     * @param int $companyId
     * @return void
     */
    private function createCompanyAddress(RecruiterRegisterCommand $command, int $companyId): void
    {
        $this->companyAddressRepository->create([
            'company_id' => $companyId,
            'province_id' => $command->province,
            'district_id' => $command->district,
        ]);
    }

}
