<?php

namespace App\Repositories\UserProfile;

use App\Entities\UserProfile\UserProfile;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class UserProfileRepositoryEloquent extends BaseRepository implements UserProfileRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserProfile::class;
    }

    /**
     * @param $pathAvatar
     * @param $userId
     * @return mixed
     */
    public function updateAvatar($pathAvatar, $userId): mixed
    {
        DB::beginTransaction();

        try {
            $user = $this->find($userId);

            $user->update([
                'avatar' => $pathAvatar
            ]);

            DB::commit();

            return $user->refresh();
        }catch (\Exception $e){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return mixed
     */
    public function updateOrCreateUserProfile(array $attributes, array $values = []): mixed
    {
        DB::beginTransaction();

        try {
            $userProfile = $this->model->updateOrCreate(
                    ['user_id' => $attributes['user_id']],
                    [
                        $values
                    ]
                );

            DB::commit();

            return $userProfile->refresh();
        }catch (\Exception $e){
            DB::rollBack();

            return null;
        }
    }
}

