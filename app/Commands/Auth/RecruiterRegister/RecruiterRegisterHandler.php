<?php

namespace App\Commands\Auth\RecruiterRegister;

use App\Enums\DefaultRole;
use App\Enums\StatusEnum;
use App\Http\Resources\Auth\RecruiterRegisterResource;
use App\Notifications\UserRegisteredNotification;
use App\Repositories\CompanySeries\Company\CompanyRepository;
use App\Repositories\CompanySeries\CompanyBranch\CompanyBranchRepository;
use App\Repositories\User\UserRepository;

class RecruiterRegisterHandler
{
    /**
     * @param UserRepository $userRepository
     * @param CompanyRepository $companyRepository
     * @param CompanyBranchRepository $companyBranchRepository
     */
    public function __construct(
        protected UserRepository $userRepository,
        protected CompanyRepository $companyRepository,
        protected CompanyBranchRepository $companyBranchRepository
    )
    {
    }

    /**
     * @param RecruiterRegisterCommand $command
     * @return array
     */
    public function handle(RecruiterRegisterCommand $command): array
    {
        try {
            $recruiter = $this->createRecruiter($command);

            if(empty($recruiter)){
                return [
                    'message' => __('messages.authentication.user_register_error'),
                ];
            }

            $company = $this->createCompany($command, $recruiter->id);

            if(!$company['success']){
                return [
                    'message' => __('messages.authentication.user_register_error'),
                ];
            }

            $this->createCompanyBranch($command, $company['data']->id);

            $recruiter->notify(new UserRegisteredNotification());

            return [
                'recruiter' => RecruiterRegisterResource::make($recruiter->refresh()),
                'message' => __('messages.authentication.user_register_success')
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.authentication.user_register_error'),
                'error' => $e
            ];
        }
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
     * @return array
     */
    private function createCompany(RecruiterRegisterCommand $command, int $userId): array
    {
        $urlAvatarDefault = asset(config('constants.default_avatar'));

        return $this->companyRepository->storeDataWithTransaction([
            'user_id' => $userId,
            'name' => $command->companyName,
            'company_scale_id' => $command->companyScaleId,
            'gender_id' => $command->genderId,
            'tax_code' => $command->taxCode,
            'status_id' => StatusEnum::DEACTIVATE->value,
            'avatar' => $urlAvatarDefault
        ]);
    }

    /**
     * @param RecruiterRegisterCommand $command
     * @param int $companyId
     * @return void
     */
    private function createCompanyBranch(RecruiterRegisterCommand $command, int $companyId): void
    {
        $this->companyBranchRepository->storeDataWithTransaction([
            'company_id' => $companyId,
            'branch_name' => $command->branchName,
            'province_id' => $command->provinceId,
            'district_id' => $command->districtId,
        ]);
    }
}
