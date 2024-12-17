<?php

namespace App\Repositories\UserProfile;

interface UserProfileRepository
{
    public function updateAvatar(string $pathAvatar, $userId);
}
