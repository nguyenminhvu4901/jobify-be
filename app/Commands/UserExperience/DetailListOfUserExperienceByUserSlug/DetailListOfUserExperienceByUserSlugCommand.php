<?php

namespace App\Commands\UserExperience\DetailListOfUserExperienceByUserSlug;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class DetailListOfUserExperienceByUserSlugCommand implements CommandInterface
{
    public function __construct(
        public readonly string $userSlug
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSlug: $request->get('user-slug')
        );
    }
}
