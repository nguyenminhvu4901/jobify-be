<?php

namespace App\Repositories\ProfileSeries\UserProfile;

interface UserProfileRepository
{
    public function updateAvatar(string $pathAvatar, $userId);

    public function updateOrCreateUserProfile(array $attributes, array $values = []);
}
