<?php

namespace App\Enums\RouteNames\Profile;

enum UserCertification: string
{
    case TAG_NAME = 'userCertifications';

    case LIST_CERTIFICATION_CURRENT_USER = 'listCertificationCurrentUser';
    case COMPLETE_LIST_USER_CERTIFICATION = 'completeListOfUserCertification';
    case DETAIL_LIST_USER_CERTIFICATION = 'detailListOfUserCertification';
    case DETAIL_LIST_USER_CERTIFICATION_BY_USER_SLUG = 'detailListOfUserCertificationByUserSlug';
    case STORE = 'store';
    case UPDATE = 'updateUserCertification';
    case DESTROY = 'destroy';
}
