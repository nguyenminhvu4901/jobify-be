<?php

namespace App\Commands\UserEducation\StoreUserEducation;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserEducationCommand implements CommandInterface
{
    public function __construct(
        public readonly string $name,
        public readonly string $major,
        public readonly bool|int|string $isStudying,
        public readonly string $startDate,
        public readonly string|null $endDate,
        public readonly ?string $description
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            name: $request->get('name'),
            major: $request->get('major'),
            isStudying: $request->get('is_studying'),
            startDate: $request->get('start_date'),
            endDate: $request->get('end_date') ?? null,
            description: $request->get('description') ?? null
        );
    }
}
