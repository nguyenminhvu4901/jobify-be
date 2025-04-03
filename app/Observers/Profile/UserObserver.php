<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserProfile;
use App\Models\User;
use App\Observers\BaseObserver;
use Ramsey\Uuid\Uuid;

class UserObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserProfile::TAG_NAME->value
    ];

    public function creating(User $user): void
    {
        if (!$user->uuid) {
            $user->uuid = Uuid::uuid4()->toString();
        }
    }
}
