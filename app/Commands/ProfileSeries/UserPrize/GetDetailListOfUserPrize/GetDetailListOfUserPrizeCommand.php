<?php

namespace App\Commands\ProfileSeries\UserPrize\GetDetailListOfUserPrize;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailListOfUserPrizeCommand implements CommandInterface
{
    public function __construct(
        public string|int $userPrizeId
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userPrizeId: $request->get('user_prize_id')
        );
    }
}
