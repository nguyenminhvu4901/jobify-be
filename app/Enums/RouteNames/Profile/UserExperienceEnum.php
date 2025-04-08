<?php

namespace App\Enums\RouteNames\Profile;

enum UserExperienceEnum: string
{
    case PREFIX = 'profile.userExperience.';

    case TAG_NAME = 'userExperiences';

    case TABLE = 'user_experiences';

    case LIST_EXPERIENCE_CURRENT_USER = 'listExperienceCurrentUser';

    case COMPLETE_LIST_USER_EXPERIENCE = 'completeListOfUserExperience';

    case DETAIL_LIST_USER_EXPERIENCE = 'detailListOfUserExperience';

    case DETAIL_LIST_USER_EXPERIENCE_BY_USER_SLUG = 'detailListOfUserExperienceByUserSlug';

    case STORE = 'store';

    case UPDATE = 'updateUserExperience';

    case DESTROY = 'destroy';
}
