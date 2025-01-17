<?php

namespace App\Commands\UserCertification\GetDetailListOfUserCertification;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class GetDetailListOfUserCertificationCommand implements CommandInterface
{
    public function __construct(
        public readonly string|int $userCertificationId
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userCertificationId: $request->get('user_certification_id')
        );
    }
}
