<?php

namespace App\Commands\ProfileSeries\UserCourse\DestroyUserCourse;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class DestroyUserCourseCommand implements CommandInterface
{
    public function __construct(
        public string|int $userCourseId,
        public string     $userSlug
    )
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userCourseId: $request->get('user_course_id'),
            userSlug: $request->get('user_slug')
        );
    }
}
