<?php

namespace App\Commands\ProfileSeries\UserCertification\DestroyUserCertification;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyUserCertificationCommand implements CommandInterface
{
    /**
     * @param string $userSlug
     * @param string|int $userCertificationId
     */
    public function __construct(
        public string     $userSlug,
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
            userSlug: $request->get('user_slug'),
            userCertificationId: $request->get('user_certification_id')
        );
    }
}
