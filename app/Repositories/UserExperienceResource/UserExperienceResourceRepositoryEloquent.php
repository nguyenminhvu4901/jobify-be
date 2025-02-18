<?php

namespace App\Repositories\UserExperienceResource;

use App\Entities\UserExperienceResource\UserExperienceResource;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserExperienceResourceRepositoryEloquent extends BaseRepository implements UserExperienceResourceRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserExperienceResource::class;
    }

    /**
     * @param array $userExperienceResourceId
     * @return mixed
     */
    public function getListUserExperienceResourceByIds(array $userExperienceResourceId): mixed
    {
        return $this->model->whereIn('id', $userExperienceResourceId)->get();
    }

    /**
     * @param UserExperienceResource $userExperienceResource
     * @return UserExperienceResource|null
     */
    public function destroy(UserExperienceResource $userExperienceResource): ?UserExperienceResource
    {
        DB::beginTransaction();

        try {
            $userExperienceResource->delete();

            DB::commit();

            return $userExperienceResource->refresh();
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }


    /**
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes): mixed
    {
        DB::beginTransaction();

        try {
            $userExperienceResource = $this->model->create($attributes);

            DB::commit();

            return $userExperienceResource;
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }


    /**
     * @param array $attributes
     * @param int|string $userExperienceResourceId
     * @return mixed
     */
    public function updateUserExperienceResource(
        array $attributes,
        int|string $userExperienceResourceId
    ): mixed
    {
        DB::beginTransaction();

        try {
            $userExperienceResource = $this->model->find($userExperienceResourceId);

            $userExperienceResource->update($attributes);

            DB::commit();

            return $userExperienceResource;
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }
}
