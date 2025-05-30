<?php

namespace App\Commands\CompanySeries\CompanyProfile\UpdateCompanyAvatar;

use App\Enums\Storage\PathStorageEnum;
use App\Http\Resources\CompanySeries\CompanyProfile\CompanyProfileResource;
use App\Repositories\CompanySeries\Company\CompanyRepository;
use App\Traits\MediaResources\ImageHandler;

class UpdateCompanyAvatarHandler
{
    use ImageHandler;

    /**
     * @param CompanyRepository $companyRepository
     */
    public function __construct(
        protected CompanyRepository $companyRepository
    )
    {
    }

    /**
     * @param UpdateCompanyAvatarCommand $command
     * @return array
     */
    public function handle(UpdateCompanyAvatarCommand $command): array
    {
        try {
            $user = auth()->user();

            $company = $this->companyRepository->find($command->companyId);

            if(!empty($command->avatar)){
                if(is_string($command->avatar)){
                    if($command->avatar != $company?->avatar){
                        $companyInfo = $this->processAvatarDefault($company);
                    }
                }else{
                    $path = PathStorageEnum::PATH_COMPANY_AVATAR->value;

                    $pathStorage = $this->updateImage($command->avatar, $path, $company->avatar, $user);

                    $companyInfo =  $this->companyRepository->updateDataWithTransaction([
                        'avatar' => $pathStorage
                    ], $company->id);
                }
            }else{
                $companyInfo = $this->processAvatarDefault($company);
            }

            if(!empty($companyInfo) && $companyInfo['success']){

                return [
                    'company' => CompanyProfileResource::make($companyInfo['data']->refresh()),
                    'message' => __('messages.company.company_update_profile_success')
                ];
            }

            return [
                'message' => __('messages.company.company_update_profile_error'),
            ];
        }catch (\Exception $e){

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e,
            ];
        }
    }

    /**
     * @param $company
     * @return array|null
     */
    private function processAvatarDefault($company): ?array
    {
        $status = $this->deleteImage($company->avatar);

        if($status){
            return $this->companyRepository->updateDataWithTransaction([
                'avatar' => asset(config('constants.default_avatar'))
            ], $company->id);
        }

        return null;
    }
}
