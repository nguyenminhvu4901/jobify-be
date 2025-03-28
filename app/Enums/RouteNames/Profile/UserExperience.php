<?php

namespace App\Enums\RouteNames\Profile;

enum UserExperience: string
{
    case PREFIX = 'profile.userExperience.';

    case TAG_NAME = 'userExperiences';

    case LIST_EXPERIENCE_CURRENT_USER = 'listExperienceCurrentUser';

    case COMPLETE_LIST_USER_EXPERIENCE = 'completeListOfUserExperience';

    case DETAIL_LIST_USER_EXPERIENCE = 'detailListOfUserExperience';

    case DETAIL_LIST_USER_EXPERIENCE_BY_USER_SLUG = 'detailListOfUserExperienceByUserSlug';

    case STORE = 'store';

    case UPDATE = 'updateUserExperience';

    case DESTROY = 'destroy';
}
