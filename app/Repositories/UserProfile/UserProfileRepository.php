<?php

namespace App\Repositories\UserProfile;

interface UserProfileRepository
{
    public function updateAvatar(string $pathAvatar, $userId);

    public function updateOrCreateUserProfile(array $attributes, array $values = []);
}
