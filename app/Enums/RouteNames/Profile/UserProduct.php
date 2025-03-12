<?php

namespace App\Enums\RouteNames\Profile;

enum UserProduct: string
{
    case TAG_NAME = 'userProducts';

    case LIST_PRODUCT_CURRENT_USER = 'listProductCurrentUser';

    case COMPLETE_LIST_USER_PRODUCT = 'completeListOfUserProduct';

    case DETAIL_LIST_USER_PRODUCT = 'detailListOfUserProduct';

    case DETAIL_LIST_USER_PRODUCT_BY_USER_SLUG = 'detailListOfUserProductByUserSlug';

    case STORE = 'store';

    case UPDATE = 'updateUserProduct';

    case DESTROY = 'destroy';
}
