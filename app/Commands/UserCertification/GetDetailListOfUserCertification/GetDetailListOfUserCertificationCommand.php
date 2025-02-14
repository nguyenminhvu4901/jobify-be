<?php

namespace App\Commands\UserCertification\GetDetailListOfUserCertification;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailListOfUserCertificationCommand implements CommandInterface
{
    /**
     * @param string|int $userCertificationId
     */
    public function __construct(
        public string|int $userCertificationId
    )
    {
    }

    /**
     * @param FormRequest $request
     * @return CommandInterface
     */
    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userCertificationId: $request->get('user_certification_id')
        );
    }
}
