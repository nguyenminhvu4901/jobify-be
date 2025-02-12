<?php

namespace App\Commands\UserEducation\StoreUserEducation;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class StoreUserEducationCommand implements CommandInterface
{
    public function __construct(
        public string          $name,
        public string          $major,
        public bool|int|string $isStudying,
        public string          $startDate,
        public string|null     $endDate,
        public ?string         $description
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
