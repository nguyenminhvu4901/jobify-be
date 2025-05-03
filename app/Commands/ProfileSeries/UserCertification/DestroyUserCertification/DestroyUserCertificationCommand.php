<?php

namespace App\Commands\ProfileSeries\UserCertification\DestroyUserCertification;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyUserCertificationCommand implements CommandInterface
{
    public function __construct(
        public string $userSlug,
        public string|int $userCertificationId
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSlug: $request->get('user_slug'),
            userCertificationId: $request->get('user_certification_id')
        );
    }
}
