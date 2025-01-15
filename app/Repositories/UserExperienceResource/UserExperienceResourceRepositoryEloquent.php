<?php

namespace App\Repositories\UserExperienceResource;

use App\Entities\UserExperienceResource\UserExperienceResource;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class UserExperienceResourceRepositoryEloquent extends BaseRepository implements UserExperienceResourceRepository
{
    public function model()
    {
        return UserExperienceResource::class;
    }

    public function getListUserExperienceResourceByIds(array $userExperienceResourceId)
    {
        return $this->model->whereIn('id', $userExperienceResourceId)->get();
    }

    public function destroy($userExperienceResource)
    {
        DB::beginTransaction();

        try {
            $userExperienceResource->delete();

            DB::commit();

            return $userExperienceResource->fresh();
        }catch (\Exception $e)
        {
            DB::rollBack();

            return null;
        }
    }
}
