<?php

namespace App\Commands\Profile\UserProduct\GetCompleteListOfUserProduct;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class GetCompleteListOfUserProductCommand implements CommandInterface
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
