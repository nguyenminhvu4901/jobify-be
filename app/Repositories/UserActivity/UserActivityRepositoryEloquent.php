<?php

namespace App\Repositories\UserActivity;

use App\Entities\UserActivity\UserActivity;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserActivityRepositoryEloquent extends BaseRepository implements UserActivityRepository
{

    /**
     * @return string
     */
    public function model(): string
    {
        return UserActivity::class;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes): mixed
    {
        DB::beginTransaction();

        try {
            $userActivity = $this->model->create($attributes);

            if(!$userActivity){
                DB::rollBack();

                return [
                    'success' => false
                ];
            }

            DB::commit();

            return [
                'success' => true,
                'data' => $userActivity
            ];
        }catch (Exception $e){
            DB::rollBack();

            return [
                'success' => false,
                'error' => $e
            ];
        }
    }

    /**
     * @param array $attributes
     * @param int $userActivityId
     * @return array
     */
    public function updateUserActivity(array $attributes, int $userActivityId): array
    {
        DB::beginTransaction();

        try {
            $userActivity = $this->findWithRelationships($userActivityId, 'userActivityResources');

            if(!$userActivity){
                DB::rollBack();

                return [
                    'success' => false,
                    'message' => __('messages.response.resource_not_found'),
                ];
            }

            $userActivity->update($attributes);

            DB::commit();

            return [
                'success' => true,
                'data' => $userActivity->refresh()
            ];
        }catch (Exception $e){
            DB::rollBack();

            return [
                'success' => false,
                'error' => $e
            ];
        }
    }

    /**
     * @param UserActivity $userActivity
     * @return array
     */
    public function destroy(UserActivity $userActivity): array
    {
        DB::beginTransaction();

        try {
            $isDeleted = $userActivity->delete();

            DB::commit();

            return [
                'success' => (bool) $isDeleted
            ];
        }catch (Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'error' => $e
            ];
        }
    }
}
