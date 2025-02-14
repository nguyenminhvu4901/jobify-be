<?php

namespace App\Repositories\UserSkill;

use App\Entities\UserSkill\UserSkill;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UserSkillRepositoryEloquent extends BaseRepository implements UserSkillRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserSkill::class;
    }

    /**
     * @param array $attributes
     * @return LengthAwarePaginator|Collection|mixed|null
     */
    public function create(array $attributes): mixed
    {
        DB::beginTransaction();

        try {
            $userSkill = $this->model->create($attributes);

            DB::commit();

            return $userSkill;
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }
}
