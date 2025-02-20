<?php

namespace App\Commands\UserPrize\GetDetailListOfUserPrizeByUserSlug;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailListOfUserPrizeByUserSlugCommand implements CommandInterface
{
    public function __construct(
        public string $userSlug
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSlug: $request->get('user_slug')
        );
    }
}
