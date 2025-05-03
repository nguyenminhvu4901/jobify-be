<?php

namespace App\Commands\CompanySeries\CompanyProfile\UpdateCompanyAvatar;

use App\Http\Resources\CompanySeries\CompanyProfile\CompanyProfileResource;
use App\Repositories\CompanySeries\Company\CompanyRepository;
use App\Traits\ImageHandler;

class UpdateCompanyAvatarHandler
{
    use ImageHandler;

    public function __construct(
        protected CompanyRepository $companyRepository
    ) {
    }

    public function handle(UpdateCompanyAvatarCommand $command): array
    {
        try {
            $user = auth()->user();

            $company = $this->companyRepository->find($command->companyId);

            if (! empty($command->avatar)) {
                if (is_string($command->avatar)) {
                    if ($command->avatar != $company?->avatar) {
                        $companyInfo = $this->processAvatarDefault($company);
                    }
                } else {
                    $path = config('constants.path_company_avatar');

                    $pathStorage = $this->storeImage($command->avatar, $path, $user);

                    $companyInfo = $this->companyRepository->updateDataWithTransaction([
                        'avatar' => $pathStorage,
                    ], $company->id);
                }
            } else {
                $companyInfo = $this->processAvatarDefault($company);
            }

            if (! empty($companyInfo) && $companyInfo['success']) {

                return [
                    'company' => CompanyProfileResource::make($companyInfo['data']->refresh()),
                    'message' => __('messages.company.company_update_profile_success'),
                ];
            }

            return [
                'message' => __('messages.company.company_update_profile_error'),
            ];
        } catch (\Exception $e) {

            return [
                'message' => __('messages.profile.user_update_profile_error'),
                'error' => $e,
            ];
        }
    }

    private function processAvatarDefault($company): ?array
    {
        $status = $this->deleteImage($company->avatar);

        if ($status) {
            return $this->companyRepository->updateDataWithTransaction([
                'avatar' => asset(config('constants.default_avatar')),
            ], $company->id);
        }

        return null;
    }
}
