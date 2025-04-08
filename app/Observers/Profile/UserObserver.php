<?php

namespace App\Observers\Profile;

use App\Enums\RouteNames\Profile\UserProfileEnum;
use App\Models\User;
use App\Observers\BaseObserver;
use Ramsey\Uuid\Uuid;

class UserObserver extends BaseObserver
{
    protected array $cacheTag = [
        UserProfileEnum::TAG_NAME->value
    ];

    public function creating(User $user): void
    {
        if (!$user->uuid) {
            $user->uuid = Uuid::uuid4()->toString();
        }
    }
}
