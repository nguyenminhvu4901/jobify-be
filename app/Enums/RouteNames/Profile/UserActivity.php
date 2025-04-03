<?php

namespace App\Enums\RouteNames\Profile;

enum UserActivity: string
{
    case PREFIX = 'profile.userActivity.';

    case TAG_NAME = 'userActivities';
    case LIST_ACTIVITY_CURRENT_USER = 'listActivityCurrentUser';
    case COMPLETE_LIST_USER_ACTIVITY = 'completeListOfUserActivity';
    case DETAIL_LIST_USER_ACTIVITY = 'detailListOfUserActivity';
    case DETAIL_LIST_USER_ACTIVITY_BY_USER_SLUG = 'detailListOfUserActivityByUserSlug';
    case STORE = 'store';
    case UPDATE = 'updateUserActivity';
    case DESTROY = 'destroy';
}
