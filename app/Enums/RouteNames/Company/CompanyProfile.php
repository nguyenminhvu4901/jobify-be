<?php

namespace App\Enums\RouteNames\Company;

enum CompanyProfile: string
{
    case PREFIX = 'company.profile.';

    case TAG_NAME = 'companies';

    case DETAIL_PROFILE_COMPANY_CURRENT_USER = 'detailProfileCompanyCurrentUser';

    case UPDATE_PROFILE_COMPANY = 'updateProfileCompany';

    case UPDATE_BRANCH_COMPANY = 'updateBranchCompany';
}
