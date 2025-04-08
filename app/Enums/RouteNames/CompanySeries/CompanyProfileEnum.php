<?php

namespace App\Enums\RouteNames\CompanySeries;

enum CompanyProfileEnum: string
{
    case PREFIX = 'company.profile.';

    case TAG_NAME = 'companies';

    case DETAIL_COMPANY_PROFILE_CURRENT_USER = 'detailCompanyProfileCurrentUser';

    case UPDATE_COMPANY_PROFILE = 'updateCompanyProfile';

    case UPDATE_COMPANY_AVATAR = 'updateCompanyAvatar';
}
