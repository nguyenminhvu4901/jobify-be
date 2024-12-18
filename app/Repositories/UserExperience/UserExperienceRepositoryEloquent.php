<?php

namespace App\Repositories\UserExperience;

use App\Entities\UserExperience\UserExperience;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class UserExperienceRepositoryEloquent extends BaseRepository implements UserExperienceRepository
{
    public function model()
    {
        return UserExperience::class;
    }

    public function create(array $data)
    {

        DB::beginTransaction();

        try {
            $userExperience = $this->model->create($data);

            DB::commit();

            return $userExperience->refresh();
        }catch (\Exception $e){
            DB::rollBack();

            return null;
        }
    }
}
