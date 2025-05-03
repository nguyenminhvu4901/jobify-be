<?php

namespace App\Repositories\ProfileSeries\UserProfile;

use App\Entities\ProfileSeries\UserProfile\UserProfile;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class UserProfileRepositoryEloquent extends BaseRepository implements UserProfileRepository
{
    public function model(): string
    {
        return UserProfile::class;
    }

    public function updateAvatar($pathAvatar, $userId): mixed
    {
        DB::beginTransaction();

        try {
            $user = $this->find($userId);

            $user->update([
                'avatar' => $pathAvatar,
            ]);

            DB::commit();

            return $user->refresh();
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }

    public function updateOrCreateUserProfile(array $attributes, array $values = []): mixed
    {
        DB::beginTransaction();

        try {
            $userProfile = $this->model->updateOrCreate(
                ['user_id' => $attributes['user_id']],
                $values
            );

            DB::commit();

            return $userProfile->refresh();
        } catch (\Exception $e) {
            DB::rollBack();

            return null;
        }
    }
}
