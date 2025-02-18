<?php

namespace App\Commands\UserCourse\GetDetailListOfUserCourseByUserSlug;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailListOfUserCourseByUserSlugCommand implements CommandInterface
{
    public function __construct(
        public string $userSlug
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userSlug: $request->get('user_slug')
        );
    }
}
