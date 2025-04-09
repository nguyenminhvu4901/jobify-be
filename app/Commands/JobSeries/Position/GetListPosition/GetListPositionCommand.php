<?php

namespace App\Commands\JobSeries\Position\GetListPosition;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetListPositionCommand implements CommandInterface
{
    public function __construct(
        public int|null $limit,
        public string|null $cursor
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            limit: $request->input('limit') ?? null,
            cursor:  $request->input('cursor') ?? null,
        );
    }
}
