<?php

namespace App\Commands\ProfileSeries\UserCourse\GetDetailListOfUserCourse;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

readonly class GetDetailListOfUserCourseCommand implements CommandInterface
{
    public function __construct(
        public string|int $userCourseId
    ) {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            userCourseId: $request->get('user_course_id')
        );
    }
}
