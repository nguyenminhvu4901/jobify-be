<?php

namespace App\Commands\Profile\UserEducation\StoreUserEducation;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class StoreUserEducationCommand implements CommandInterface
{
    /**
     * @param string $name
     * @param string $major
     * @param bool|int|string $isStudying
     * @param string $startDate
     * @param string|null $endDate
     * @param string|null $description
     */
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

    /**
     * @param FormRequest $request
     * @return CommandInterface
     */
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
