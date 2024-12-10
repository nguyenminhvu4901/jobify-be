<?php

namespace App\Repositories\CompanyAddress;

use App\Entities\Company\Company;
use App\Entities\CompanyAddress\CompanyAddress;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;

class CompanyAddressRepositoryEloquent extends BaseRepository implements CompanyAddressRepository
{
    public function model()
    {
        return CompanyAddress::class;
    }

    /**
     * @param array $data
     * @return LengthAwarePaginator|Collection|mixed|null
     */
    public function create(array $data): mixed
    {
        DB::beginTransaction();

        try {
            $companyAddress = $this->model->create($data);

            DB::commit();

            return $companyAddress->refresh();
        }catch (\Exception $e){
            DB::rollBack();

            return null;
        }
    }


}
