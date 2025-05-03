<?php

namespace App\Commands\ProfileSeries\UserCertification\GetDetailListOfUserCertification;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailListOfUserCertificationCommand implements CommandInterface
{
    public function __construct(
        public string|int $userCertificationId
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userCertificationId: $request->get('user_certification_id')
        );
    }
}
