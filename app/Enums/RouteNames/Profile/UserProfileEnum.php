<?php

namespace App\Enums\RouteNames\Profile;

enum UserProfileEnum: string
{
    case TAG_NAME = 'userProfiles';

    case TABLE = 'user_profiles';

    case INFORMATION_CV_CURRENT_USER = 'informationCVCurrentUser';

    case INFORMATION_CURRENT_USER = 'informationCurrentUser';

    case UPDATE_PROFILE = 'updateProfile';

    case UPLOAD_AVATAR = 'uploadAvatar';
}
