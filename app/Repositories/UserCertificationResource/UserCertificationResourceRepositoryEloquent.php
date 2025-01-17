<?php

namespace App\Repositories\UserCertificationResource;

use App\Entities\UserCertificationResource\UserCertificationResource;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class UserCertificationResourceRepositoryEloquent extends BaseRepository implements UserCertificationResourceRepository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return UserCertificationResource::class;
    }

    public function destroy($userCertificationResource)
    {
        DB::beginTransaction();

        try {
            $userCertificationResource->delete();

            DB::commit();

            return $userCertificationResource->fresh();
        }catch (\Exception $e)
        {
            DB::rollBack();

            return null;
        }
    }

}
