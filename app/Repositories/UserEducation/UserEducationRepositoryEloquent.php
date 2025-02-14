<?php

namespace App\Repositories\UserEducation;

use App\Entities\UserEducation\UserEducation;
use App\Repositories\BaseRepository;
use Exception;
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

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data): mixed
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

    /**
     * @param array $data
     * @param int|string $userEducationId
     * @return mixed
     */
    public function updateUserEducation(array $data, int|string $userEducationId): mixed
    {
        DB::beginTransaction();

        try {
            $userEducation = $this->model->find($userEducationId);

            $userEducation->update($data);

            DB::commit();

            return $userEducation->refresh();
        }catch (\Exception $e){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param UserEducation $userEducation
     * @return bool
     */
    public function destroy(UserEducation $userEducation): bool
    {
        DB::beginTransaction();

        try {
            $userEducation->delete();

            DB::commit();

            return true;
        }catch (Exception)
        {
            DB::rollBack();

            return false;
        }
    }
}
