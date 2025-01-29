<?php

namespace App\Commands\UserEducation\GetDetailListOfUserEducation;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class GetDetailListOfUserEducationCommand implements CommandInterface
{
    public function __construct(
        public readonly int|string $userEducationId
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
