<?php

namespace App\Commands\UserEducation\GetDetailListOfUserEducation;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailListOfUserEducationCommand implements CommandInterface
{
    public function __construct(
        public int|string $userEducationId
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userEducationId: $request->get('user_education_id')
        );
    }
}
