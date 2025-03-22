<?php

namespace App\Commands\Profile\UserPrize\GetCompleteListOfUserPrize;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetCompleteListOfUserPrizeCommand implements CommandInterface
{
    public function __construct(
        public int|null $page,
        public int|null $limit
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            page: $request->input('page') ?? null,
            limit: $request->input('limit') ?? null
        );
    }
}
