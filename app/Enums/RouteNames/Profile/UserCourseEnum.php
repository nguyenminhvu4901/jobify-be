<?php

namespace App\Enums\RouteNames\Profile;

enum UserCourseEnum: string
{
    case PREFIX = 'profile.userCourse.';

    case TAG_NAME = 'userCourses';

    case TABLE = 'user_courses';

    case LIST_COURSE_CURRENT_USER = 'listCourseCurrentUser';

    case COMPLETE_LIST_USER_COURSE = 'completeListOfUserCourse';

    case DETAIL_LIST_USER_COURSE = 'detailListOfUserCourse';

    case DETAIL_LIST_USER_COURSE_BY_USER_SLUG = 'detailListOfUserCourseByUserSlug';

    case STORE = 'store';

    case UPDATE = 'updateUserCourse';

    case DESTROY = 'destroy';
}
