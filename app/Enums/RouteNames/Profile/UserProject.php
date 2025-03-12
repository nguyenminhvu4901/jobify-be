<?php

namespace App\Enums\RouteNames\Profile;

enum UserProject: string
{
    case TAG_NAME = 'userProjects';

    case LIST_PROJECT_CURRENT_USER = 'listProjectCurrentUser';

    case COMPLETE_LIST_USER_PROJECT = 'completeListOfUserProject';

    case DETAIL_LIST_USER_PROJECT = 'detailListOfUserProject';

    case DETAIL_LIST_USER_PROJECT_BY_USER_SLUG = 'detailListOfUserProjectByUserSlug';

    case STORE = 'store';

    case UPDATE = 'updateUserProject';

    case DESTROY = 'destroy';
}
