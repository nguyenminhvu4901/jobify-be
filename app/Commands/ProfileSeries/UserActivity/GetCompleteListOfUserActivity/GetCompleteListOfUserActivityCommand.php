<?php

namespace App\Commands\ProfileSeries\UserActivity\GetCompleteListOfUserActivity;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class GetCompleteListOfUserActivityCommand implements CommandInterface
{
    public function __construct(
        public ?int $page,
        public ?int $limit,
        public ?string $cursor
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            page: $request->input('page') ?? null,
            limit: $request->input('limit') ?? null,
            cursor: $request->input('cursor') ?? null,
        );
    }
}
