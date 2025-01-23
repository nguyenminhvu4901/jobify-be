<?php

namespace App\Repositories\UserEducation;

use App\Entities\UserEducation\UserEducation;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;

class UserEducationRepositoryEloquent extends BaseRepository implements UserEducationRepository
{

    /**
     * @return string|null
     */
    public function model(): ?string
    {
        return UserEducation::class;
    }

    public function store(array $data)
    {
        DB::beginTransaction();

        try {
            $userEducation = $this->model->create($data);

            DB::commit();

            return $userEducation;
        }catch (\Exception $e){
            DB::rollBack();

            return null;
        }
    }
}
