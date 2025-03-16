<?php

namespace App\Observers;

use App\Enums\RouteNames\Profile\UserProfile;
use App\Models\User;
use App\Observers\Profile\BaseProfileObserver;
use Ramsey\Uuid\Uuid;

class UserObserver extends BaseProfileObserver
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
