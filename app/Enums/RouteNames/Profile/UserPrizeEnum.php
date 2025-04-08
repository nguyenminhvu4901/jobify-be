<?php

namespace App\Enums\RouteNames\Profile;

enum UserPrizeEnum: string
{
    case PREFIX = 'profile.userPrize.';

    case TAG_NAME = 'userPrizes';

    case TABLE = 'user_prizes';

    case LIST_PRIZE_CURRENT_USER = 'listPrizeCurrentUser';

    case COMPLETE_LIST_USER_PRIZE = 'completeListOfUserPrize';

    case DETAIL_LIST_USER_PRIZE = 'detailListOfUserPrize';

    case DETAIL_LIST_USER_PRIZE_BY_USER_SLUG = 'detailListOfUserPrizeByUserSlug';

    case STORE = 'store';

    case UPDATE = 'updateUserPrize';

    case DESTROY = 'destroy';
}
