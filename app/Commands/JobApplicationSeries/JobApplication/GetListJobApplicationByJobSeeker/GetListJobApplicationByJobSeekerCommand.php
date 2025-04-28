<?php

namespace App\Commands\JobApplicationSeries\JobApplication\GetListJobApplicationByJobSeeker;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetListJobApplicationByJobSeekerCommand implements CommandInterface
{
    public function __construct(
        public int $userId,
        public int|null $limit,
        public string|null $page
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userId: $request->input('user_id'),
            limit: $request->input('limit') ?? null,
            page:  $request->input('page') ?? null,
        );
    }
}
