<?php

namespace App\Enums\RouteNames\Profile;

enum UserSkillEnum: string
{
    case PREFIX = 'profile.userSkill.';

    case TAG_NAME = 'userSkills';

    case TABLE = 'user_skills';

    case LIST_SKILL_CURRENT_USER = 'listSkillCurrentUser';

    case COMPLETE_LIST_USER_SKILL = 'completeListOfUserSkill';

    case DETAIL_LIST_USER_SKILL = 'detailListOfUserSkill';

    case DETAIL_LIST_USER_SKILL_BY_USER_SLUG = 'detailListOfUserSkillByUserSlug';

    case STORE = 'store';

    case UPDATE = 'updateUserSkill';

    case DESTROY = 'destroy';
}
