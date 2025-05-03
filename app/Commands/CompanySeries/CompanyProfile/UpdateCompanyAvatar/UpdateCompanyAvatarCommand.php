<?php

namespace App\Commands\CompanySeries\CompanyProfile\UpdateCompanyAvatar;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

readonly class UpdateCompanyAvatarCommand implements CommandInterface
{
    /**
     * @param string|int $companyId
     * @param UploadedFile|string|null $avatar
     */
    public function __construct(
        public string|int $companyId,
        public UploadedFile|null|string $avatar
    )
    {
    }

    /**
     * @param FormRequest $request
     * @return CommandInterface
     */
    public static function withForm(FormRequest $request): CommandInterface
    {
        $avatarRequest = null;
        if (!empty($request->file('avatar'))){

            $avatarRequest = $request->file('avatar');
        }
        elseif(!empty($request->input('avatar')))
        {
            $avatarRequest = trim($request->input('avatar'));
        }

        return new self(
            companyId: $request->input('company_id'),
            avatar: $avatarRequest
        );
    }
}
