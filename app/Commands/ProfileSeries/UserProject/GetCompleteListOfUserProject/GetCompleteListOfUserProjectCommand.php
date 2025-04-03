<?php

namespace App\Commands\ProfileSeries\UserProject\GetCompleteListOfUserProject;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class GetCompleteListOfUserProjectCommand implements CommandInterface
{
    public function __construct(
        public int|null $page,
        public int|null $limit,
        public string|null $cursor
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            page: $request->input('page') ?? null,
            limit: $request->input('limit') ?? null,
            cursor:  $request->input('cursor') ?? null,
        );
    }
}
