<?php

namespace App\Commands\ProfileSeries\UserPrize\DestroyUserPrize;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyUserPrizeCommand implements CommandInterface
{
    public function __construct(
        public string $userSlug,
        public int|string $userPrizeId
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSlug: $request->get('user_slug'),
            userPrizeId: $request->get('user_prize_id')
        );
    }
}
