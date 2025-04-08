<?php

namespace App\Enums\RouteNames\Profile;

enum UserEducationEnum: string
{
    case PREFIX = 'profile.userEducation.';

    case TAG_NAME = 'userEducations';

    case TABLE = 'user_educations';

    case LIST_EDUCATION_CURRENT_USER = 'listEducationCurrentUser';

    case COMPLETE_LIST_USER_EDUCATION = 'completeListOfUserEducation';

    case DETAIL_LIST_USER_EDUCATION = 'detailListOfUserEducation';

    case DETAIL_LIST_USER_EDUCATION_BY_USER_SLUG = 'detailListOfUserEducationByUserSlug';

    case STORE = 'store';

    case UPDATE = 'updateUserEducation';

    case DESTROY = 'destroy';
}
