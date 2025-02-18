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
     * @param $attachment
     * @param $userExperienceId
     * @param $pathStorage
     * @return mixed
     */
    public function store($attachment, $userExperienceId, $pathStorage): mixed
    {
        DB::beginTransaction();

        try {
            $userExperienceResource = $this->model->create([
                'user_experience_id' => $userExperienceId,
                'title' => $attachment['title'],
                'path' => $pathStorage,
                'description' => $attachment['description'],
                'content_type_id' => $attachment['content_type_id']
            ]);

            DB::commit();

            return $userExperienceResource->refresh();
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param array $attachment
     * @param int|string $userExperienceResourceId
     * @param string $pathStorage
     * @return mixed
     */
    public function updateUserExperienceResource(
        array $attachment,
        int|string $userExperienceResourceId,
        string $pathStorage
    ): mixed
    {
        DB::beginTransaction();

        try {
            $userExperienceResource = $this->model->find($userExperienceResourceId);

            $userExperienceResource->update(
                [
                'title' => $attachment['title'],
                'path' => $pathStorage,
                'description' => $attachment['description'],
                'content_type_id' => $attachment['content_type_id']
            ]);

            DB::commit();

            return $userExperienceResource->refresh();
        }catch (Exception)
        {
            DB::rollBack();

            return null;
        }
    }
}
