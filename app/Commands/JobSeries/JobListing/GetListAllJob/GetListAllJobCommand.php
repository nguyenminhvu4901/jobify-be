<?php

namespace App\Commands\JobSeries\JobListing\GetListAllJob;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetListAllJobCommand implements CommandInterface
{
    public function __construct(
        public ?int $limit,
        public ?string $page
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            limit: $request->input('limit') ?? null,
            page: $request->input('page') ?? null,
        );
    }
}
