<?php

namespace App\Commands\ProfileSeries\UserEducation\DestroyUserEducation;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyUserEducationCommand implements CommandInterface
{
    public function __construct(
        public string $userSlug,
        public int|string $userEducationId,
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSlug: $request->get('user_slug'),
            userEducationId: $request->get('user_education_id')
        );
    }
}
