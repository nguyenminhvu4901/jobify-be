<?php

namespace App\Repositories\UserProduct;

use App\Entities\UserProduct\UserProduct;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;

class UserProductRepositoryEloquent extends BaseRepository implements UserProductRepository
{
    /**
     * @return string
     */
    public function model(): string
    {
        return UserProduct::class;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function store(array $attributes): mixed
    {
        DB::beginTransaction();

        try {
            $userProduct = $this->model->create($attributes);

            DB::commit();

            return $userProduct;
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param array $attributes
     * @param $userProductId
     * @return mixed
     */
    public function updateUserProduct(array $attributes, $userProductId): mixed
    {
        DB::beginTransaction();

        try {
            $userProduct = $this->model->find($userProductId);

            $userProduct->update($attributes);

            DB::commit();

            return $userProduct;
        }catch (Exception){
            DB::rollBack();

            return null;
        }
    }

    /**
     * @param UserProduct $userProduct
     * @return bool
     */
    public function destroy(UserProduct $userProduct): bool
    {
        DB::beginTransaction();

        try {
            $userProduct->delete();

            DB::commit();

            return true;
        }catch (Exception)
        {
            DB::rollBack();

            return false;
        }
    }
}
