<?php

namespace App\Enums\RouteNames\Profile;

enum UserLocation: string
{
    case PREFIX = 'profile.userLocation.';

    case TAG_NAME = 'userLocations';

    case LIST_LOCATION_CURRENT_USER = 'listLocationCurrentUser';

    case COMPLETE_LIST_USER_LOCATION = 'completeListOfUserLocation';

    case DETAIL_LIST_USER_LOCATION = 'detailListOfUserLocation';

    case DETAIL_LIST_USER_LOCATION_BY_USER_SLUG = 'detailListOfUserLocationByUserSlug';

    case STORE = 'store';

    case UPDATE = 'updateUserLocation';

    case DESTROY = 'destroy';
}
