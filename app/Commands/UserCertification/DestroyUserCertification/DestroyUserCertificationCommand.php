<?php

namespace App\Commands\UserCertification\DestroyUserCertification;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class DestroyUserCertificationCommand implements CommandInterface
{
    public function __construct(
        public readonly string $userSlug,
        public readonly string|int $userCertificationId
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSlug: $request->get('user_slug'),
            userCertificationId: $request->get('user_certification_id')
        );
    }
}
