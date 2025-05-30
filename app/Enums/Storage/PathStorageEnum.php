<?php

namespace App\Enums\Storage;

enum PathStorageEnum: string
{
    case PATH_AVATAR = 'app/avatars/users';

    case PATH_COMPANY_AVATAR = 'app/avatars/companies';

    case PATH_CSV = 'app/cvs/files/%s/%s/%s';

    case PATH_PROFILE = 'app/profiles/';
}
