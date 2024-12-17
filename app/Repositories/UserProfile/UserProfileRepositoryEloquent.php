<?php

namespace App\Repositories\UserProfile;

use App\Entities\UserProfile\UserProfile;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class UserProfileRepositoryEloquent extends BaseRepository implements UserProfileRepository
{
    public function model()
    {
        return UserProfile::class;
    }

    public function updateAvatar($pathAvatar, $userId)
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
}

