<?php

namespace App\Commands\JobSeries\JobListing\SearchJob;

use App\Commands\CommandInterface;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

readonly class SearchJobCommand implements CommandInterface
{
    public function __construct(
        public ?string $search
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            search: $request->input('search') ?? ""
        );
    }
}
